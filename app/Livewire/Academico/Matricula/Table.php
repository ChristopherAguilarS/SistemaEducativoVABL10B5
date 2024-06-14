<?php

namespace App\Livewire\Academico\Matricula;

use App\Livewire\Forms\CrearMacroProcesoForm;
use App\Models\Curso;
use App\Models\MacroProceso;
use App\Models\Matricula;
use App\Models\TipoProceso;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearMacroProcesoForm $form;
    public $titulo = 'Crear Nueva Matricula';
    public $tituloRequisito = 'Crear Nuevo Pre Requisito';
    public $macroProcesoT;
    public $macroProcesoId;
    public $mensaje;
    public $tipo_procesos;
    public $tipoProcesoId;
    public $busqueda;

    public function mount(){
        $this->tipo_procesos = TipoProceso::where('estado',1)->get();
    }

    #[On('enviarTipoProcesoId')]
    public function obtenerTipoProcesoId($id){
        $this->tipoProcesoId = $id;
        $this->render();
    }

    #[On('enviarBusqueda')]
    public function obtenerBusqueda($texto){
        $this->busqueda = $texto;
        $this->render();
    }

    #[On('agregar')]
    public function agregar(){
        $this->macroProcesoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva Matricula';
    }

    public function editar($id){
        $macroProceso = MacroProceso::find($id);
        $this->titulo = 'Editar Matricula -'.optional($this->macroProcesoT)->descripcion;
        $this->macroProcesoId = $id;
        $this->form->descripcion = $macroProceso->descripcion;
        $this->form->tipo_proceso_id = $macroProceso->tipo_proceso_id;
    }

    public function cambiarEstado($id){
        $macroProceso = MacroProceso::find($id);
        $macroProceso->estado = !$macroProceso->estado;
        $macroProceso->save();
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
        if($this->macroProcesoId == null){
            $this->mensaje = "Macro Proceso registrado exitosamente";
        }
        else{
            $this->mensaje = "Macro Proceso actualizado exitosamente";
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
                text: "No se pudo registrar el macro proceso",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function guardar(){
        $this->form->validate();
        try {
            $tipo = MacroProceso::updateOrCreate(
                [
                    'id'=>$this->macroProcesoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'tipo_proceso_id'=> $this->form->tipo_proceso_id,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            $this->mensajedeError();
        }
        
    }

    public function render()
    {
        $matriculas = Matricula::where('estado',1)->paginate(10);
        return view('livewire.academico.matricula.table',['matriculas'=>$matriculas]);
    }
}
