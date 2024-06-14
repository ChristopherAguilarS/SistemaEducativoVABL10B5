<?php

namespace App\Livewire\FinancieroContable\Presupuestal\AccionesEstrategicasPriorizadas;

use App\Livewire\Forms\CrearAccionEstrategicaPriorizadaForm;
use App\Models\AccionEstrategicaPriorizada;
use App\Models\ObjetivoEstrategico;
use App\Models\Proceso;
use App\Models\ProcesoAccionEstrategicaPriorizada;
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
    public CrearAccionEstrategicaPriorizadaForm $form;
    public $titulo = 'Crear Nuevo Accion estrategica priorizada';
    public $accionEstrategicaPriorizadaT;
    public $accionEstrategicaPriorizadaId;
    public $mensaje;
    public $objetivos_estrategicos;
    public $objetivoEstrategicoId;
    public $busqueda;
    public $tituloProceso;
    public $procesosSeleccionados = [];
    public $procesos;
    public $objetivoId;
    public $proceso_id;

    public function mount(){
        $this->objetivos_estrategicos = ObjetivoEstrategico::where('estado',1)->get();
    }

    #[On('enviarPlanId')]
    public function obtenerObjetivoEstrategicoId($id){
        $this->objetivoEstrategicoId = $id;
        $this->render();
    }

    #[On('enviarBusqueda')]
    public function obtenerBusqueda($texto){
        $this->busqueda = $texto;
        $this->render();
    }

    #[On('agregar')]
    public function agregar(){
        $this->accionEstrategicaPriorizadaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Accion estrategica priorizada';
    }

    public function editar($id){
        $accionEstrategicaPriorizada = AccionEstrategicaPriorizada::find($id);
        $this->titulo = 'Editar Accion estrategica priorizada -'.optional($this->accionEstrategicaPriorizadaT)->descripcion;
        $this->accionEstrategicaPriorizadaId = $id;
        $this->form->codigo = $accionEstrategicaPriorizada->codigo;
        $this->form->descripcion = $accionEstrategicaPriorizada->descripcion;
        $this->form->monto_asignado = $accionEstrategicaPriorizada->monto_asignado;
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
            $this->mensaje = "Accion estrategica priorizada registrado exitosamente";
        }
        else{
            $this->mensaje = "Accion estrategica priorizada actualizado exitosamente";
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
                text: "No se pudo registrar el accion estrategica priorizada",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function guardar(){
        $nro_objetivo = AccionEstrategicaPriorizada::where('objetivo_estrategico_id', $this->form->objetivo_estrategico_id)->max('codigo');
        if($nro_objetivo == null){
            $nro_objetivo = 1;
        }
        else{
            $nro_objetivo = $nro_objetivo+1;
        }
        try {
            $tipo = AccionEstrategicaPriorizada::updateOrCreate(
                [
                    'id'=>$this->accionEstrategicaPriorizadaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $nro_objetivo,
                    'objetivo_estrategico_id'=> $this->form->objetivo_estrategico_id,
                    'monto_asignado' => 0,
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
        $accionesEstrategicasPriorizadas = AccionEstrategicaPriorizada::when($this->objetivoEstrategicoId != null, function ($query) {
                return $query->where('plan_anual_trabajo_id',$this->objetivoEstrategicoId);
            })
            ->when($this->busqueda != null, function ($query) {
                return $query->where('descripcion', 'like', '%' . $this->busqueda . '%');
            })->paginate(10);
        return view('livewire.financiero-contable.presupuestal.acciones-estrategicas-priorizadas.table',['accionesEstrategicasPriorizadas'=>$accionesEstrategicasPriorizadas]);
    }
}
