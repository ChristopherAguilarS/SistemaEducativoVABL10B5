<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ObjetivosEstrategicos;

use App\Livewire\Forms\CrearObjetivoEstrategicoForm;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanAnualTrabajo;
use App\Models\Proceso;
use App\Models\ProcesoObjetivoEstrategico;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearObjetivoEstrategicoForm $form;
    public $titulo = 'Crear Nuevo Objetivo Estrategico';
    public $objetivoEstrategicoT;
    public $objetivoEstrategicoId;
    public $mensaje;
    public $plan_anuales;
    public $planAnualId;
    public $busqueda;
    public $tituloProceso;
    public $procesosSeleccionados = [];
    public $procesos;
    public $objetivoId;
    public $proceso_id;

    public function mount(){
        $this->plan_anuales = PlanAnualTrabajo::where('estado',1)->get();
        $this->procesos = Proceso::where('estado',1)->get();
    }

    #[On('enviarPlanId')]
    public function obtenerPlanAnualId($id){
        $this->planAnualId = $id;
        $this->render();
    }

    #[On('enviarBusqueda')]
    public function obtenerBusqueda($texto){
        $this->busqueda = $texto;
        $this->render();
    }

    #[On('agregar')]
    public function agregar(){
        $this->objetivoEstrategicoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Objetivo Estrategico';
    }

    public function agregarProcesos($id){
        $this->objetivoId = $id;
        $objetivoEstrategico = ObjetivoEstrategico::find($id);
        $this->tituloProceso = 'Agregar Procesos a OE.'.optional($objetivoEstrategico)->codigo.'-'.optional($objetivoEstrategico)->descripcion;
        $procesosSeleccionados = ProcesoObjetivoEstrategico::where('objetivo_estrategico_id', $this->objetivoId)->get();
        $procesosSeleccionados = $procesosSeleccionados->toArray();
        $this->procesosSeleccionados = [];
        foreach ($procesosSeleccionados as $proceso) {
            $p = [];
            $p['id'] = $proceso['id'];
            $p['proceso_id'] = $proceso['proceso_id'];
            $p['proceso_descripcion'] = Proceso::find($proceso['proceso_id'])->descripcion;
            $p['objetivo_estrategico_id'] = $proceso['objetivo_estrategico_id'];
            array_push($this->procesosSeleccionados,$p);
        }
    }

    public function adjuntarProceso(){
        $proceso = [];
        $array= array_column($this->procesosSeleccionados, 'proceso_id');
        if (in_array($this->proceso_id, $array)) {
            $this->mensajeAdjuntoAnteriormente();
        } else {
            $proceso['id'] = null;
            $proceso['objetivo_estrategico_id'] = $this->objetivoId;
            $proceso['proceso_id'] = $this->proceso_id;
            $proceso['proceso_descripcion'] = Proceso::find($this->proceso_id)->descripcion;
            array_push($this->procesosSeleccionados,$proceso);
            $this->mensajeAdjuntoExitosamente();
        }
    }

    public function retirarProceso($id){ 
        unset($this->procesosSeleccionados[$id]);
    }

    public function guardarProcesos(){
        try {
            ProcesoObjetivoEstrategico::where('objetivo_estrategico_id', $this->objetivoId)->update(['estado' => 0]);
            foreach ($this->procesosSeleccionados as $item) {
                ProcesoObjetivoEstrategico::updateOrCreate(
                    [
                        "proceso_id" => $item["proceso_id"],
                        "objetivo_estrategico_id" => $this->objetivoId,
                    ],
                    [
                        "estado"=>1,
                        "created_by" => Auth::user()->id,
                        "updated_by" => Auth::user()->id
                    ]
                );
            }
            $this->mensajeProcesosGuardadosExitosamente();
            $this->cerrarModalProcesos();
        } catch (\Exception $e) {
            dd($e);
        }
        
    }

    public function editar($id){
        $objetivoEstrategico = ObjetivoEstrategico::find($id);
        $this->titulo = 'Editar Objetivo Estrategico -'.optional($this->objetivoEstrategicoT)->descripcion;
        $this->objetivoEstrategicoId = $id;
        $this->form->codigo = $objetivoEstrategico->codigo;
        $this->form->descripcion = $objetivoEstrategico->descripcion;
        $this->form->monto_asignado = $objetivoEstrategico->monto_asignado;
    }

    public function cambiarEstado($id){
        $objetivoEstrategico = ObjetivoEstrategico::find($id);
        $objetivoEstrategico->estado = !$objetivoEstrategico->estado;
        $objetivoEstrategico->save();
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
    public function cerrarModalProcesos()
    {
       
        $this->js(<<<'JS'
            $('#myModalProceso').modal('hide')
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
        if($this->objetivoEstrategicoId == null){
            $this->mensaje = "Objetivo Estrategico registrado exitosamente";
        }
        else{
            $this->mensaje = "Objetivo Estrategico actualizado exitosamente";
        }
        $this->js(<<<'JS'
            Toastify({
                text: $wire.mensaje,
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajeAdjuntoExitosamente()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "Proceso adjuntado exitosamente",
                className: "success"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajeProcesosGuardadosExitosamente()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "Procesos relacionados exitosamente",
                className: "success"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajeAdjuntoAnteriormente()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "El proceso ya esta adjunto",
                style: {
                    background: "#F88E06",
                }
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeError()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "No se pudo registrar el objetivo estrategico",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function guardar(){
        $this->form->validate();
        $nro_objetivo = ObjetivoEstrategico::where('plan_anual_trabajo_id', $this->form->plan_anual_trabajo_id)->max('codigo');
        if($nro_objetivo == null){
            $nro_objetivo = 1;
        }
        else{
            $nro_objetivo = $nro_objetivo+1;
        }
        try {
            $tipo = ObjetivoEstrategico::updateOrCreate(
                [
                    'id'=>$this->objetivoEstrategicoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $nro_objetivo,
                    'plan_anual_trabajo_id'=> $this->form->plan_anual_trabajo_id,
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
        $objetivoEstrategicos = ObjetivoEstrategico::when($this->planAnualId != null, function ($query) {
                return $query->where('plan_anual_trabajo_id',$this->planAnualId);
            })
            ->when($this->busqueda != null, function ($query) {
                return $query->where('descripcion', 'like', '%' . $this->busqueda . '%');
            })->paginate(10);
        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.table',['objetivoEstrategicos'=>$objetivoEstrategicos]);
    }
}
