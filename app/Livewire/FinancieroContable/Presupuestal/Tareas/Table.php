<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Tareas;

use App\Livewire\Forms\CrearTareaForm;
use App\Models\ActividadOperativa;
use App\Models\CategoriaTarea;
use App\Models\Cuenta;
use App\Models\Indicador;
use App\Models\Tarea;
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
    public $tareaId;
    public $tareaT;
    public $titulo;
    public $cuentas;
    public $cuenta_id;
    public $categorias = [];
    public CrearTareaForm $form;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';
    public $indicadores;

    public $fecha_inicio;
    public $fecha_fin;

    public function mount(){
        $this->indicadores = Indicador::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('agregar')]
    public function agregar(){
        $this->tareaId = null;
        $this->deshabilitar = '';
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Ejecucion Gasto';
    }

    public function editar($id){
        $tarea = Tarea::find($id);
        $this->titulo = 'Editar Ejecucion Gasto - '.optional($tarea)->descripcion;
        $this->tareaId = $id;
        $this->form->descripcion = $tarea->descripcion;
        /*$this->form->cuenta_id = $tarea->cuenta_id;
        $this->form->fecha = $tarea->fecha;
        $this->form->comprobante = $tarea->comprobante;
        $this->form->categoria_id = $tarea->categoria_id;
        $this->form->descripcion_categoria = $tarea->descripcion_categoria;
        $this->form->monto = $tarea->monto;
        $this->form->tipo = $tarea->tipo;*/
        $this->dispatch('cambiarSeleccion', id: $tarea->cuenta_id);
    }

    public function cambiarEstado($id){
        $tarea = Tarea::find($id);
        $tarea->estado = !$tarea->estado;
        $tarea->save();        
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
        if($this->tareaId == null){
            $this->mensaje = "tarea registrado exitosamente";
        }
        else{
            $this->mensaje = "tarea actualizado exitosamente";
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
                text: "No se pudo registrar la tarea",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }



    public function guardar(){
        $this->form->validate();
        $nro_tarea = Tarea::where('indicador_id', $this->form->indicador_id)->max('codigo');
        if($nro_tarea == null){
            $nro_tarea = 1;
        }
        else{
            $nro_tarea = $nro_tarea+1;
        }
        try {
            $tipo = Tarea::updateOrCreate(
                [
                    'id'=>$this->tareaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $nro_tarea,
                    'meta' => $this->form->meta,
                    'meta_ejecutada' => 0,
                    'porcentaje_avance' => 0,
                    'indicador_id' => $this->form->indicador_id,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();
            $this->limpiarCampos();
            $this->cerrarModal();
            $this->dispatch('actualizarCards');
            if($tipo->categoria_id == 8){
                $mAC = Tarea::where('categoria_id',1)->where('estado',1)->first();
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
        $tareas = Tarea::where('estado',1)->paginate(10);
        return view('livewire.financiero-contable.presupuestal.tareas.table',['tareas'=>$tareas]);
    }
}
