<?php

namespace App\Livewire\FinancieroContable\Contabilidad\CajaChica;

use App\Livewire\Forms\CrearCajaCajaChicaForm;
use App\Livewire\Forms\CrearCajaChicaForm;
use App\Models\AñoAcademico;
use App\Models\CajaChica;
use App\Models\CategoriaCajaCajaChica;
use App\Models\Cuenta;
use App\Models\Indicador;
use App\Models\CajaCajaChica;
use App\Models\RecursosHumanos\Persona;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $mensaje;
    public $cajaId;
    public $cajaT;
    public $titulo;
    public $indicadores;
    public $indicador_id;
    public $categorias = [];
    public CrearCajaChicaForm $form;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';
    public $tituloApertura = '';

    public $años_academicos;
    public $responsables;

    public function mount(){
        $this->años_academicos = AñoAcademico::where('estado',1)->orderBy('descripcion')->get();
        $this->responsables = Persona::where('estado',1)->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->cajaId = null;
        $this->deshabilitar = '';
        $this->apertura = false;
        $this->cierre = false;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo caja';
    }

    public function editar($id){
        $caja = CajaChica::find($id);
        $this->titulo = 'Editar Caja - '.optional($caja)->descripcion;
        $this->cajaId = $id;
        $this->form->descripcion = $caja->descripcion;
        $this->form->responsable_id = $caja->responsable_id;
        $this->form->fecha_creacion = $caja->fecha_creacion;
        $this->form->año_academico_id = $caja->año_academico_id;
        $this->form->monto_inicial = $caja->monto_inicial;
        $this->form->fuente_financiamiento = $caja->fuente_financiamiento;
        $this->form->decreto = $caja->decreto;
        $this->dispatch('cambiarSeleccion', id: $caja->indicador_id);
    }

    public function cambiarEstado($id){
        $caja = CajaChica::find($id);
        $caja->estado = !$caja->estado;
        $caja->save();        
        $this->dispatch('actualizarCards');
        $this->mensajedeExitoCambioEstado();
    }

    public function limpiarCampos(){
        $this->form->limpiarCampos();
    }

    #[Js] 
    public function cerrarModal()
    {
       
        $this->js(<<<'JS'
            $('#myModal').modal('hide')
        JS);
    }

    #[Js] 
    public function mensajedeExitoCambioEstado()
    {
        $this->js(<<<'JS'
            Toastify({
                avatar: "",
                text: "Cambio de estado exitosamente",
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeExito()
    {
        if($this->cajaId == null){
            $this->mensaje = "caja registrado exitosamente";
        }
        else{
            $this->mensaje = "caja actualizado exitosamente";
        }
        $this->js(<<<'JS'
            Toastify({
                text: $wire.mensaje,
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeError()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "No se pudo registrar la caja",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }



    public function guardar(){
        $this->form->validate();
        try {
            $tipo = CajaChica::updateOrCreate(
                [
                    'id'=>$this->cajaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,                    
                    'fecha_creacion' => $this->form->fecha_creacion,                    
                    'responsable_id' => $this->form->responsable_id,
                    'año_academico_id' => $this->form->año_academico_id,
                    'monto_inicial' => $this->form->monto_inicial,
                    'fuente_financiamiento' => $this->form->fuente_financiamiento,
                    'decreto' => $this->form->decreto,
                    'ruta_decreto' => $this->form->ruta_decreto,                    
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();
            $this->limpiarCampos();
            $this->cerrarModal();
            $this->dispatch('actualizarCards');
            if($tipo->categoria_id == 8){
                $mAC = CajaChica::where('categoria_id',1)->where('estado',1)->first();
                $mAC->estado = 2;
                $mAC->save();
            }
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
        
    }
    
    public function render()
    {
        $cajas = CajaChica::where('estado',1)->paginate(10);
        return view('livewire.financiero-contable.contabilidad.caja-chica.table',['cajas'=>$cajas]);
    }
}
