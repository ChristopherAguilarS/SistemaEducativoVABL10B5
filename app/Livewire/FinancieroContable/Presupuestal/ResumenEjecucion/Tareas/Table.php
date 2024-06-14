<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\Tareas;

use App\Livewire\Forms\CrearTareaEjecutadaForm;
use App\Livewire\Forms\CrearTareaForm;
use App\Models\ActividadOperativa;
use App\Models\CategoriaTarea;
use App\Models\Cuenta;
use App\Models\EspecificaNivel2;
use App\Models\Indicador;
use App\Models\Responsable;
use App\Models\Tarea;
use App\Models\TareaEjecutada;
use App\Services\ActualizarMontoTareaService;
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
    public CrearTareaEjecutadaForm $formTarea;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';
    public $indicadores;

    public $tituloTareas;

    public $tareaSeleccionada;
    public $objetivoSeleccionado;
    public $actividadSeleccionada;
    public $indicadorSeleccionado;

    public $fecha_inicio;
    public $fecha_fin;

    public $tareasEjecutadas = [];
    public $especificas;

    public $tituloTareaEjecutada;

    public $responsables;

    public $tareaEjecutadaId = null;

    public function mount(){
        $this->indicadores = Indicador::where('estado',1)->orderBy('descripcion')->get();
        $this->tituloTareas = '';
        $this->especificas = EspecificaNivel2::where('estado',1)->get();
        $this->responsables = Responsable::where('estado',1)->orderBy('descripcion')->get();
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
        $this->titulo = 'Crear Nuevo Ejecucion del Gasto';
    }

    public function agregarTareaEjecutada(){
        $this->tituloTareaEjecutada = 'Crear Nuevo Ejecucion del Gasto';
    }

    public function tareasEjecutadasP($id){
        $this->tareaId = $id;
        $tarea = Tarea::find($id);
        $this->tareasEjecutadas = TareaEjecutada::where('tarea_id',$id)->get();
        $this->tituloTareas = 'Ejecucion del Gasto '.optional($tarea)->descripcion;
    }

    public function editar($id){
        $tarea = Tarea::find($id);
        $this->titulo = 'Editar Ejecucion del Gasto - '.optional($tarea)->descripcion;
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
    public function cerrarModalTareaEjecutada()
    {
        $this->js(<<<'JS'
            $('#myModalTareaEjecutada').modal('hide')
        JS);
    }

    public function guardarTareaEjecutada(){
        try {
            $tipo = TareaEjecutada::updateOrCreate(
                [
                    'id'=>$this->tareaEjecutadaId,
                ],
                [
                    'tipo_requerimiento' => $this->formTarea->tipo_requerimiento,
                    'nro_requerimiento' => $this->formTarea->nro_requerimiento,
                    'tipo_comprobante' => $this->formTarea->tipo_comprobante,
                    'nro_comprobante' => $this->formTarea->nro_comprobante,
                    'descripcion' => $this->formTarea->descripcion,
                    'importe' => $this->formTarea->importe,
                    'fecha_emision' => $this->formTarea->fecha_emision,
                    'especifica_nivel_2_id' => $this->formTarea->especifica_nivel_2_id,
                    'responsable_id' => $this->formTarea->responsable_id,
                    'tarea_id' => $this->tareaId,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();
            $this->limpiarCampos();
            $this->cerrarModalTareaEjecutada();
            $this->actualizarMontoTarea();
            $this->actualizarMontoIndicador();
            $this->actualizarMontoActividad();
            $this->render();
            $this->dispatch('actualizarTablaIndicadores');
            $this->dispatch('actualizarTablaActividades');
            $this->dispatch('actualizarCardsPrincipal');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function actualizarMontoTarea(){
        $tarea = Tarea::find($this->tareaId);
        $monto = TareaEjecutada::where('tarea_id',$this->tareaId)->sum('importe');
        $tarea->monto_ejecutado = $monto;
        $tarea->saldo = $tarea->monto_asignado - $monto;
        $tarea->save();
    }

    public function actualizarMontoIndicador(){
        $tarea = Tarea::find($this->tareaId);
        $monto = Tarea::where('indicador_id',$tarea->indicador_id)->sum('monto_ejecutado');
        $indicador = Indicador::find($tarea->indicador_id);
        $indicador->monto_ejecutado = $monto;
        $indicador->saldo = $indicador->monto_asignado - $monto;
        $indicador->save();
    }

    public function actualizarMontoActividad(){
        $tarea = Tarea::find($this->tareaId);
        $monto = Indicador::where('actividad_operativa_id',$tarea->indicador->actividad_operativa_id)->sum('monto_ejecutado');
        $actividad = ActividadOperativa::find($tarea->indicador->actividad_operativa_id);
        $actividad->monto_ejecutado = $monto;
        $actividad->saldo = $actividad->monto_asignado - $monto;
        $actividad->save();
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

    public function tooltip($id){
        $this->tareaSeleccionada = Tarea::find($id);
        $this->titulo = 'Detalle de Tarea';
    }

    #[On('enviarObjetivoEstrategico')]
    public function recibirObjetivoSeleccionado($objetivoSeleccionado){
        $this->objetivoSeleccionado = $objetivoSeleccionado;
    }

    #[On('enviarActividadOperativa')]
    public function recibirActividadSeleccionado($actividadSeleccionada){
        $this->actividadSeleccionada = $actividadSeleccionada;
    }

    #[On('reiniciarTareas')]
    public function reiniciarTareas(){
        $this->render();
    }
    
    public function render()
    {
        $tareas = Tarea::when($this->objetivoSeleccionado, function ($query) {
            return $query->whereHas('indicador.actividad_operativa.objetivo_estrategico', function ($query) {
                $query->where('id', $this->objetivoSeleccionado);
            });
        })
        ->when($this->actividadSeleccionada, function ($query) {
            return $query->whereHas('indicador.actividad_operativa', function ($query) {
                $query->where('id', $this->actividadSeleccionada);
            });
        })
        ->when($this->indicadorSeleccionado, function ($query) {
            return $query->where('indicador_id', $this->indicadorSeleccionado);
        })
        ->where('estado',1)->paginate(10);
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.tareas.table',['tareas'=>$tareas]);
    }
}
