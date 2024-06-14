<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\Indicadores;

use App\Livewire\Forms\CrearIndicadorForm;
use App\Livewire\Forms\CrearTareaEjecutadaForm;
use App\Models\AccionEstrategicaPriorizada;
use App\Models\ActividadOperativa;
use App\Models\AñoAcademico;
use App\Models\CategoriaIndicador;
use App\Models\Cuenta;
use App\Models\EspecificaNivel2;
use App\Models\Indicador;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanAnualTrabajo;
use App\Models\Responsable;
use App\Models\TareaEjecutada;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $mensaje;
    public $indicadorId;
    public $indicadorT;
    public $titulo;
    public $cuentas;
    public $cuenta_id;
    public $categorias = [];
    public CrearIndicadorForm $form;
    public CrearTareaEjecutadaForm $formTarea;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';
    public $actividades;

    public $fecha_inicio;
    public $fecha_fin;

    public $añoSeleccionado;
    public $planSeleccionado;
    public $actividadSeleccionada;
    public $objetivoSeleccionado;

    public $indicadorSeleccionado;

    public $filaSeleccionada;

    public $tareasEjecutadas = [];
    public $especificas;
    public $tareaId;
    public $tituloTareas;

    public $tituloTareaEjecutada;

    public $responsables;

    public $tareaEjecutadaId = null;

    public function mount(){
        $fecha = Carbon::now();
        $año = $fecha->year-1;
        $añoAcademicoSeleccionado = AñoAcademico::where('año',$año)->first();  
        $this->añoSeleccionado = optional($añoAcademicoSeleccionado)->id;
        $planSeleccionado = PlanAnualTrabajo::where('año_academico_id',$this->añoSeleccionado)->first();
        $this->planSeleccionado = optional($planSeleccionado)->id;
        $this->especificas = EspecificaNivel2::where('estado',1)->get();
        $this->responsables = Responsable::where('estado',1)->orderBy('descripcion')->get();
        $this->formTarea->tipo_requerimiento = 1;
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
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo indicador';
        $this->form->monto_asignado = 0;
    }

    public function tooltip($id){
        $this->indicadorSeleccionado = Indicador::find($id);
        $this->titulo = 'Detalle de Indicador';
    }

    public function editar($id){
        $indicador = Indicador::find($id);
        $this->titulo = 'Editar Indicador - '.optional($indicador)->descripcion;
        $this->indicadorId = $id;
        $this->form->descripcion = $indicador->descripcion;
        $this->form->monto_asignado = $indicador->monto;
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
    public function cerrarModalTareaEjecutada()
    {
        $this->js(<<<'JS'
            $('#myModalTareaEjecutada').modal('hide')
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

    #[Js] 
    public function mensajedeErrorMontoExcesivo()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "No se pudo registrar la ejecucion del gasto, ya que el acumulado seria mayor al monto asignado del indicador",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function seleccionarFila($filaId)
    {
        $this->filaSeleccionada = $filaId;
        $this->dispatch('enviarIndicador',$this->filaSeleccionada);
    }  

    public function limpiarSeleccion(){
        $this->filaSeleccionada = null;
        $this->dispatch('enviarActividadOperativa',$this->filaSeleccionada);
    }

    public function tareasEjecutadasP($id){
        $this->indicadorId = $id;
        $indicador = Indicador::find($id);
        $this->tareasEjecutadas = TareaEjecutada::where('indicador_id',$id)->get();
        $this->tituloTareas = 'Indicador '.optional($indicador)->descripcion;
    }

    public function agregarTareaEjecutada(){
        $this->tituloTareaEjecutada = 'Crear Nuevo Ejecucion del Gasto';
    }

    public function guardar(){
        if($this->indicadorId != null){
            $indicador = Indicador::find($this->indicadorId);
            if($indicador != null){
                $saldo = $indicador->saldo;
            }
            else{
                $saldo =0;
            }
        }
        else{
            $saldo = 0;
        }
        $this->form->validate();
        try {
            $tipo = Indicador::updateOrCreate(
                [
                    'id'=>$this->indicadorId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'meta' => $this->form->meta,
                    'actividad_operativa_id' => $this->form->actividad_operativa_id,
                    'monto' => $this->form->monto_asignado,
                    'saldo' => $this->form->saldo,
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

    public function guardarTareaEjecutada(){
        if($this->formTarea->nro_comprobante != null){
            $nombre = $this->formTarea->nro_comprobante. '.pdf';
        }
        else{
            $nombre = $this->indicadorId. '.pdf';
        }
             
        if($this->formTarea->documento){
            $this->formTarea->ruta_documento_sustento = $this->formTarea->documento->storeAs('documentos/comprobantes/',$nombre,'public');
        }   
        $indicador = Indicador::find($this->indicadorId);
        if($indicador->monto_asignado >= ($indicador->monto_ejecutado+$this->formTarea->importe)){    
            try {
                $tipo = TareaEjecutada::updateOrCreate(
                    [
                        'id'=>$this->tareaEjecutadaId,
                    ],
                    [
                        'tipo_requerimiento' => $this->formTarea->tipo_requerimiento,
                        'nro_requerimiento' => $this->formTarea->nro_requerimiento,
                        'tipo_comprobante' => $this->formTarea->tipo_comprobante,
                        'comprobante' => $this->formTarea->nro_comprobante,
                        'descripcion' => $this->formTarea->descripcion,
                        'importe' => $this->formTarea->importe,
                        'fecha_emision_documento' => $this->formTarea->fecha_emision,
                        'especifica_nivel_2_id' => $this->formTarea->especifica_nivel_2_id,
                        'responsable_id' => $this->formTarea->responsable_id,
                        'indicador_id' => $this->indicadorId,
                        'ruta_documento_sustento' => $this->formTarea->ruta_documento_sustento ?: null,
                        'estado' => 1,
                        'created_by' => Auth::user()->id
                    ]);
                $this->mensajedeExito();
                $this->limpiarCampos();
                $this->cerrarModalTareaEjecutada();
                $this->actualizarMontoIndicador();            
                $this->actualizarMontoActividad();            
                $this->actualizarMontoAccionEstrategica();
                $this->actualizarMontoObjetivoEstrategico();
                $this->render();
                $this->dispatch('actualizarTablaIndicadores');
                $this->dispatch('actualizarTablaActividades');
                $this->dispatch('actualizarCardsPrincipal');
            } catch (\Exception $e) {
                dd($e);
            }
        }
        else{
            $this->mensajedeErrorMontoExcesivo();
        }
    }

    public function actualizarMontoIndicador(){
        $monto = TareaEjecutada::where('indicador_id',$this->indicadorId)->sum('importe');
        $indicador = Indicador::find($this->indicadorId);
        $indicador->monto_ejecutado = $monto;
        $indicador->saldo = $indicador->monto_asignado - $monto;
        $indicador->save();
    }

    public function verificarMontoIndicador(){
        $monto = TareaEjecutada::where('indicador_id',$this->indicadorId)->sum('importe');
        $indicador = Indicador::find($this->indicadorId);
        $indicador->monto_ejecutado = $monto;
        $indicador->saldo = $indicador->monto_asignado - $monto;
        $indicador->save();
    }

    public function actualizarMontoActividad(){
        $indicador = Indicador::find($this->indicadorId);
        $monto = Indicador::where('actividad_operativa_id',$indicador->actividad_operativa_id)->sum('monto_ejecutado');
        $actividad = ActividadOperativa::find($indicador->actividad_operativa_id);
        $actividad->monto_ejecutado = $monto;
        $actividad->saldo = $actividad->monto_asignado - $monto;
        $actividad->save();
    }

    public function actualizarMontoAccionEstrategica(){
        $indicador = Indicador::find($this->indicadorId);
        $monto = ActividadOperativa::where('accion_estrategica_priorizada_id',$indicador->actividad_operativa->accion_estrategica_priorizada_id)->sum('monto_ejecutado');
        $accion = AccionEstrategicaPriorizada::find($indicador->actividad_operativa->accion_estrategica_priorizada_id);
        $accion->monto_ejecutado = $monto;
        $accion->saldo = $accion->monto_asignado - $monto;
        $accion->save();
    }

    public function actualizarMontoObjetivoEstrategico(){
        $indicador = Indicador::find($this->indicadorId);
        $monto = AccionEstrategicaPriorizada::where('objetivo_estrategico_id',$indicador->actividad_operativa->accion_estrategica_priorizada->objetivo_estrategico_id)->sum('monto_ejecutado');
        $objetivo = ObjetivoEstrategico::find($indicador->actividad_operativa->accion_estrategica_priorizada->objetivo_estrategico_id);
        $objetivo->monto_ejecutado = $monto;
        $objetivo->saldo = $objetivo->monto_asignado - $monto;
        $objetivo->save();
    }

    #[On('enviarObjetivoEstrategico')]
    public function recibirObjetivoSeleccionado($objetivoSeleccionado){
        $this->objetivoSeleccionado = $objetivoSeleccionado;
    }

    #[On('enviarActividadOperativa')]
    public function recibirActividadSeleccionado($actividadSeleccionada){
        $this->actividadSeleccionada = $actividadSeleccionada;
    }

    #[On('reiniciarIndicadores')]
    public function reiniciarIndicadores(){
        $this->render();
    }
    
    #[On('actualizarTablaIndicadores')]
    public function render()
    {
        $indicadores = Indicador::when($this->objetivoSeleccionado, function ($query) {
            return $query->whereHas('actividad_operativa.accion_estrategica_priorizada', function ($query) {
                $query->where('id', $this->objetivoSeleccionado);
            });
        })
        ->when($this->actividadSeleccionada, function ($query) {
            return $query->where('actividad_operativa_id', $this->actividadSeleccionada);
        })
        ->where('estado',1)->paginate(10);
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.indicadores.table',['indicadores'=>$indicadores]);
    }
}
