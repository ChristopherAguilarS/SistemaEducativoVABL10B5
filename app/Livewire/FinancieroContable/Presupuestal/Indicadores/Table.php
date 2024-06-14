<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Indicadores;

use App\Livewire\Forms\CrearIndicadorForm;
use App\Livewire\Forms\CrearIndicadorPIMForm;
use App\Models\ActividadOperativa;
use App\Models\CategoriaIndicador;
use App\Models\Cuenta;
use App\Models\Indicador;
use App\Models\IndicadorPIM;
use App\Models\Responsable;
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
    public $indicadorId;
    public $indicadorT;
    public $titulo;
    public $cuentas;
    public $cuenta_id;
    public $categorias = [];
    public CrearIndicadorForm $form;
    public CrearIndicadorPIMForm $formDetalle;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';
    public $actividades;

    public $fecha_inicio;
    public $fecha_fin;

    public $responsables;

    public $tarea;
    public $tareasAdjuntas;

    public $actividadOperativaId;

    public $busqueda;

    public $tituloPIM;

    public function mount(){
        $this->responsables = Responsable::where('estado',1)->orderBy('descripcion')->get();
        $this->actividades = ActividadOperativa::where('estado',1)->orderBy('descripcion')->get();
        $this->tareasAdjuntas = [];
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
        $this->tareasAdjuntas = [];
    }

    public function agregarPIM($id){
        $this->indicadorId = $id;
        $indicador = Indicador::find($id);
        $this->tituloPIM = 'Agregar PIM '.optional($indicador)->codigo.'-'.optional($indicador)->descripcion;
        $this->form->monto_asignado = 0;
        $this->tareasAdjuntas = [];
    }

    public function guardarPIM(){
        $this->formDetalle->validate();
        try {
            $indicadorPIM = IndicadorPIM::create(
                [
                    'descripcion' => $this->formDetalle->descripcion,
                    'indicador_id' => $this->indicadorId,
                    'resolucion' => $this->formDetalle->resolucion,
                    'importe' => $this->formDetalle->importe,
                    'fecha'=>$this->formDetalle->fecha,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]
            );
            $indicador = Indicador::find($this->indicadorId);
            $indicador->monto_pim = $this->formDetalle->importe;
            $indicador->aumento_disminucion = $indicador->monto_pia - $indicador->monto_pim;
            $indicador->save();
            $this->mensajedeExitoPIM();
            $this->limpiarCamposPIM();
            $this->cerrarModalPIM();    
        } catch (\Exception $e) {
            dd($e);
        }
        
    }

    public function limpiarCamposPIM(){
        $this->formDetalle->limpiarCampos();
    }

    public function adjuntarTarea(){
        if($this->tarea != null || $this->tarea!= ''){
            $a = [];
            $a['id'] = null;
            $a['descripcion'] = $this->tarea;
            $a['estado'] = 1;
            array_push($this->tareasAdjuntas,$a);
            $this->tarea = '';
        }
    }

    public function retirarTarea($id){ 
        unset($this->tareasAdjuntas[$id]);
    }

    public function editar($id){
        $this->tareasAdjuntas = [];
        $indicador = Indicador::find($id);
        $tareas = Tarea::where('estado',1)->where('indicador_id',$id)->get();
        foreach ($tareas as $tarea) {
            $a = [];
            $a['id'] = $tarea->id;
            $a['descripcion'] = $tarea->descripcion;
            $a['estado'] = $tarea->estado;
            array_push($this->tareasAdjuntas, $a);
        }
        $this->titulo = 'Editar Indicador - '.optional($indicador)->descripcion;
        $this->indicadorId = $id;
        $this->form->descripcion = $indicador->descripcion;
        $this->form->monto_asignado = $indicador->monto_asignado;
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
    public function cerrarModalPIM()
    {
        $this->js(<<<'JS'
            $('#myModalPIM').modal('hide')
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
    public function mensajedeExitoPIM()
    {
        $this->mensaje = "PIM registrado exitosamente";
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

    #[On('enviarActividadOperativaId')]
    public function obtenerActividadOperativaId($id){
        $this->actividadOperativaId = $id;
        $this->render();
    }

    #[On('enviarBusqueda')]
    public function obtenerBusqueda($texto){
        $this->busqueda = $texto;
        $this->render();
    }

    public function guardar(){
        $nro_indicador = Indicador::where('actividad_operativa_id', $this->form->actividad_operativa_id)->max('codigo');
        if($nro_indicador == null){
            $nro_indicador = 1;
        }
        else{
            $nro_indicador = $nro_indicador+1;
        }
        if($this->indicadorId != null){
            $indicador = Indicador::find($this->indicadorId);
            if($indicador != null){
                $saldo = $indicador->saldo;
            }
            else{
                $saldo =$this->form->monto_asignado;
            }
        }
        else{
            $saldo = $this->form->monto_asignado;
        }
        $this->form->validate();
        try {
            $indicadorN = Indicador::updateOrCreate(
                [
                    'id'=>$this->indicadorId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $nro_indicador,
                    'meta' => $this->form->meta,
                    'meta_ejecutada' => 0,
                    'porcentaje_avance' => 0,
                    'actividad_operativa_id' => $this->form->actividad_operativa_id,
                    'monto_asignado' => $this->form->monto_asignado,
                    'monto_ejecutado' => 0,
                    'responsable_id' => $this->form->responsable_id,
                    'responsables' => $this->form->responsables,
                    'bienes_servicios' =>$this->form->bienes_servicios,
                    'saldo' => $saldo,
                    'monto_pia' => $this->form->monto_asignado,
                    'fecha_inicio'=>$this->form->fecha_inicio,
                    'fecha_fin'=>$this->form->fecha_fin,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();
            $this->limpiarCampos();
            $this->cerrarModal();
            $this->dispatch('actualizarCards');
            if($indicadorN->categoria_id == 8){
                $mAC = Indicador::where('categoria_id',1)->where('estado',1)->first();
                $mAC->estado = 2;
                $mAC->save();
            }
            $tareas = Tarea::where('indicador_id',$this->indicadorId)->update(['estado' => 0]);
            foreach ($this->tareasAdjuntas as $tarea) {
                $t = Tarea::updateOrCreate(
                    [
                        'id'=>$tarea['id'],
                    ],
                    [
                        'indicador_id'=>$indicadorN->id,
                        'descripcion' => $tarea['descripcion'],
                        'estado' => 1,
                        'created_by' => Auth::user()->id
                    ]);
            }
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
        
    }
    
    public function render()
    {
        $indicadores = Indicador::when($this->actividadOperativaId != null, function ($query) {
            return $query->where('actividad_operativa_id',$this->actividadOperativaId);
        })
        ->when($this->busqueda != null, function ($query) {
            return $query->where('descripcion', 'like', '%' . $this->busqueda . '%');
        })->paginate(10);
        return view('livewire.financiero-contable.presupuestal.indicadores.table',['indicadores'=>$indicadores]);
    }
}
