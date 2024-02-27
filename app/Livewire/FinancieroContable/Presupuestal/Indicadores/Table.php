<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Indicadores;

use App\Livewire\Forms\CrearIndicadorForm;
use App\Models\CategoriaIndicador;
use App\Models\Cuenta;
use App\Models\Indicador;
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
    public $indicadorId;
    public $indicadorT;
    public $titulo;
    public $cuentas;
    public $cuenta_id;
    public $categorias = [];
    public CrearIndicadorForm $form;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';

    public $fecha_inicio;
    public $fecha_fin;

    public function mount(){
        $this->cuentas = Cuenta::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('agregar')]
    public function agregar(){
        $this->indicadorId = null;
        $this->deshabilitar = '';
        $this->apertura = false;
        $this->cierre = false;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo indicador';
    }

    public function editar($id){
        $indicador = Indicador::find($id);
        $this->titulo = 'Editar Indicador - '.optional($indicador)->descripcion;
        $this->indicadorId = $id;
        $this->form->descripcion = $indicador->descripcion;
        /*$this->form->cuenta_id = $indicador->cuenta_id;
        $this->form->fecha = $indicador->fecha;
        $this->form->comprobante = $indicador->comprobante;
        $this->form->categoria_id = $indicador->categoria_id;
        $this->form->descripcion_categoria = $indicador->descripcion_categoria;
        $this->form->monto = $indicador->monto;
        $this->form->tipo = $indicador->tipo;*/
        $this->dispatch('cambiarSeleccion', id: $indicador->cuenta_id);
    }

    public function cambiarEstado($id){
        $indicador = Indicador::find($id);
        $indicador->estado = !$indicador->estado;
        $indicador->save();        
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
        if($this->indicadorId == null){
            $this->mensaje = "indicador registrado exitosamente";
        }
        else{
            $this->mensaje = "indicador actualizado exitosamente";
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
                text: "No se pudo registrar la indicador",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }



    public function guardar(){
        $this->form->validate();
        $mId = null;
        if($this->form->categoria_id != 1){
            $mAC = Indicador::where('categoria_id',1)->where('estado',1)->first();
            $mId = $mAC->id;
        }
        try {
            $tipo = Indicador::updateOrCreate(
                [
                    'id'=>$this->indicadorId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'cuenta_id' => $this->form->cuenta_id,
                    'fecha' => $this->form->fecha,
                    'tipo' => $this->form->tipo,
                    'categoria_id' => $this->form->categoria_id,
                    'comprobante' => $this->form->comprobante,
                    'descripcion_categoria' => $this->form->descripcion_categoria,
                    'indicador_apertura_id' => $mId,
                    'monto' => $this->form->monto,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();
            $this->limpiarCampos();
            $this->cerrarModal();
            $this->dispatch('actualizarCards');
            if($tipo->categoria_id == 8){
                $mAC = Indicador::where('categoria_id',1)->where('estado',1)->first();
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
        $indicadores = Indicador::where('estado',1)->paginate(10);
        return view('livewire.financiero-contable.presupuestal.indicadores.table',['indicadores'=>$indicadores]);
    }
}
