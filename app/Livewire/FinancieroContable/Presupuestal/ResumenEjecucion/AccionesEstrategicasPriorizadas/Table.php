<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\AccionesEstrategicasPriorizadas;

use App\Livewire\Forms\CrearAccionEstrategicaPriorizadaForm;
use App\Models\AccionEstrategicaPriorizada;
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
    public CrearAccionEstrategicaPriorizadaForm $form;
    public $titulo = 'Crear Nuevo Accion Estrategica';
    public $accionEstrategicaPriorizadaT;
    public $accionEstrategicaPriorizadaId;
    public $mensaje;
    public $plan_anuales;
    public $objetivos_estrategicos;
    public $actividadSeleccionada;
    public $añoSeleccionado;
    public $planSeleccionado;
    public $objetivoSeleccionado;
    public $filaSeleccionada;

    public function mount(){
        $this->objetivos_estrategicos = ObjetivoEstrategico::where('estado',1)->get();
        $fecha = Carbon::now();  
    }

    #[On('agregar')]
    public function agregar(){
        $this->accionEstrategicaPriorizadaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Accion Estrategica';
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
        $this->dispatch('enviarAccionEstrategicaPriorizada',$this->filaSeleccionada);
    }

    public function limpiarSeleccion(){
        $this->filaSeleccionada = null;
        $this->dispatch('enviarAccionEstrategicaPriorizada',$this->filaSeleccionada);
    }

    public function editar($id){
        $accionEstrategicaPriorizada = AccionEstrategicaPriorizada::find($id);
        $this->titulo = 'Editar Accion Estrategica -'.optional($this->accionEstrategicaPriorizadaT)->descripcion;
        $this->accionEstrategicaPriorizadaId = $id;
        $this->form->codigo = $accionEstrategicaPriorizada->codigo;
        $this->form->descripcion = $accionEstrategicaPriorizada->descripcion;
        $this->form->objetivo_estrategico_id = $accionEstrategicaPriorizada->objetivo_estrategico_id;
        $this->form->monto_asignado = $accionEstrategicaPriorizada->monto;
    }

    public function cambiarEstado($id){
        $accionEstrategicaPriorizada = AccionEstrategicaPriorizada::find($id);
        $accionEstrategicaPriorizada->estado = !$accionEstrategicaPriorizada->estado;
        $accionEstrategicaPriorizada->save();
        $this->mensajedeExitoCambioEstado();
    }

    public function limpiarCampos(){
        $this->form->limpiarCampos();
    }

    public function tooltip($id){
        $this->actividadSeleccionada = AccionEstrategicaPriorizada::find($id);
        $this->titulo = 'Detalle de Accion Estrategica';
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
        if($this->accionEstrategicaPriorizadaId == null){
            $this->mensaje = "Accion Estrategica registrado exitosamente";
        }
        else{
            $this->mensaje = "Accion Estrategica actualizado exitosamente";
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
                text: "No se pudo registrar el accion estrategica",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function guardar(){
        if($this->accionEstrategicaPriorizadaId != null){
            $actividad = AccionEstrategicaPriorizada::find($this->accionEstrategicaPriorizadaId);
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
            $tipo = AccionEstrategicaPriorizada::updateOrCreate(
                [
                    'id'=>$this->accionEstrategicaPriorizadaId,
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
        $accionEstrategicas = AccionEstrategicaPriorizada::query()
        ->when($this->objetivoSeleccionado != null, function ($query) {
            return $query->where('objetivo_estrategico_id', $this->objetivoSeleccionado);
        })->where('estado',1)->paginate(10);
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.acciones-estrategicas-priorizadas.table',['accionEstrategicas'=>$accionEstrategicas]);
    }
}
