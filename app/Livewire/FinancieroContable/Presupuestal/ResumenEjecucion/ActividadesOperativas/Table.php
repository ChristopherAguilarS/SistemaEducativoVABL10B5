<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\ActividadesOperativas;

use App\Livewire\Forms\CrearActividadOperativaForm;
use App\Models\ActividadOperativa;
use App\Models\AñoAcademico;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanAnualTrabajo;
use Carbon\Carbon;
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
    public $objetivos_estrategicos;
    public $actividadSeleccionada;
    public $añoSeleccionado;
    public $planSeleccionado;
    public $objetivoSeleccionado;
    public $filaSeleccionada;

    public function mount(){
        $this->plan_anuales = PlanAnualTrabajo::where('estado',1)->get();
        $this->objetivos_estrategicos = ObjetivoEstrategico::where('estado',1)->get();
        $fecha = Carbon::now();
        $año = $fecha->year-1;
        $añoAcademicoSeleccionado = AñoAcademico::where('año',$año)->first();  
        $this->añoSeleccionado = optional($añoAcademicoSeleccionado)->id;
        $this->planSeleccionado = PlanAnualTrabajo::where('año_academico_id',$this->añoSeleccionado)->first();
    }

    #[On('agregar')]
    public function agregar(){
        $this->actividadOperativaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Actividad Operativa';
    }

    #[On('enviarObjetivoEstrategico')]
    public function obtenerObjetivoEstrategico($objetivoSeleccionado){
        $this->objetivoSeleccionado = $objetivoSeleccionado;
        $this->render();
        $this->dispatch('reiniciarIndicadores',$this->filaSeleccionada);
    }

    public function seleccionarFila($filaId)
    {
        $this->filaSeleccionada = $filaId;
        $this->dispatch('enviarActividadOperativa',$this->filaSeleccionada);
    }

    public function limpiarSeleccion(){
        $this->filaSeleccionada = null;
        $this->dispatch('enviarActividadOperativa',$this->filaSeleccionada);
    }

    public function editar($id){
        $actividadOperativa = ActividadOperativa::find($id);
        $this->titulo = 'Editar Actividad Operativa -'.optional($this->actividadOperativaT)->descripcion;
        $this->actividadOperativaId = $id;
        $this->form->codigo = $actividadOperativa->codigo;
        $this->form->descripcion = $actividadOperativa->descripcion;
        $this->form->objetivo_estrategico_id = $actividadOperativa->objetivo_estrategico_id;
        $this->form->monto_asignado = $actividadOperativa->monto;
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

    public function tooltip($id){
        $this->actividadSeleccionada = ActividadOperativa::find($id);
        $this->titulo = 'Detalle de Actividad Operativa';
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
            $tipo = ActividadOperativa::updateOrCreate(
                [
                    'id'=>$this->actividadOperativaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'objetivo_estrategico_id' => 1,
                    'monto_asignado' => $this->form->monto_asignado,
                    'saldo' => 0,
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

    #[On('actualizarTablaActividades')]
    public function render()
    {
        $actividadOperativas = ActividadOperativa::query()
        ->when($this->objetivoSeleccionado != null, function ($query) {
            return $query->where('accion_estrategica_priorizada_id', $this->objetivoSeleccionado);
        })->where('estado',1)->paginate(10);
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.actividades-operativas.table',['actividadOperativas'=>$actividadOperativas]);
    }
}
