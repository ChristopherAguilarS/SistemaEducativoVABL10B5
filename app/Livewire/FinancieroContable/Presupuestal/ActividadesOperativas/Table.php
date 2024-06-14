<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ActividadesOperativas;

use App\Livewire\Forms\CrearActividadOperativaForm;
use App\Models\AccionEstrategicaPriorizada;
use App\Models\ActividadOperativa;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanAnualTrabajo;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearActividadOperativaForm $form;
    public $titulo = 'Crear Nuevo Actividad Operativa';
    public $actividadOperativaT;
    public $actividadOperativaId;
    public $mensaje;
    public $plan_anuales;
    public $acciones_estrategicas_priorizadas;

    public function mount(){
        $this->acciones_estrategicas_priorizadas = AccionEstrategicaPriorizada::where('estado',1)->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->actividadOperativaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Actividad Operativa';
    }

    public function editar($id){
        $actividadOperativa = ActividadOperativa::find($id);
        $this->titulo = 'Editar Actividad Operativa -'.optional($this->actividadOperativaT)->descripcion;
        $this->actividadOperativaId = $id;
        $this->form->descripcion = $actividadOperativa->descripcion;
        $this->form->accion_estrategica_priorizada_id = $actividadOperativa->accion_estrategica_priorizada_id;
        $this->form->monto_asignado = $actividadOperativa->monto_asignado;
    }

    public function cambiarEstado($id){
        $actividadOperativa = ActividadOperativa::find($id);
        $actividadOperativa->estado = !$actividadOperativa->estado;
        $actividadOperativa->save();
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
        if($this->actividadOperativaId == null){
            $this->mensaje = "Actividad Operativa registrado exitosamente";
        }
        else{
            $this->mensaje = "Actividad Operativa actualizado exitosamente";
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
                text: "No se pudo registrar el actividad operativa",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function guardar(){
        if($this->actividadOperativaId != null){
            $actividad = ActividadOperativa::find($this->actividadOperativaId);
            if($actividad != null){
                $saldo = $actividad->saldo;
            }
            else{
                $saldo =0;
            }
        }
        else{
            $saldo = 0;
        }
        try {
            $nro_actividad = ActividadOperativa::where('accion_estrategica_priorizada_id', $this->form->accion_estrategica_priorizada_id)->max('codigo');
            if($nro_actividad == null){
                $nro_actividad = 1;
            }
            else{
                $nro_actividad = $nro_actividad+1;
            }
            $tipo = ActividadOperativa::updateOrCreate(
                [
                    'id'=>$this->actividadOperativaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $nro_actividad,
                    'accion_estrategica_priorizada_id' => $this->form->accion_estrategica_priorizada_id,
                    'monto_asignado' => $this->form->monto_asignado,
                    'monto_ejecutado' => 0,
                    'saldo' => $this->form->monto_asignado,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            dd($e);
            $this->mensajedeError();
        }
        
    }

    public function render()
    {
        $actividadOperativas = ActividadOperativa::paginate(10);
        return view('livewire.financiero-contable.presupuestal.actividades-operativas.table',['actividadOperativas'=>$actividadOperativas]);
    }
}
