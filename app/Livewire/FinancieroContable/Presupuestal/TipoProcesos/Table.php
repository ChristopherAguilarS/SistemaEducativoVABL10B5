<?php

namespace App\Livewire\FinancieroContable\Presupuestal\TipoProcesos;

use App\Livewire\Forms\CrearTipoProcesoForm;
use App\Models\TipoProceso;
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
    public CrearTipoProcesoForm $form;
    public $titulo = 'Crear Nuevo Tipo de proceso';
    public $tipoProcesoT;
    public $tipoProcesoId;
    public $mensaje;
    public $plan_anuales;
    public $planAnualId;
    public $busqueda;

    public function mount(){
        
    }

    #[On('enviarBusqueda')]
    public function obtenerBusqueda($texto){
        $this->busqueda = $texto;
        $this->render();
    }

    #[On('agregar')]
    public function agregar(){
        $this->tipoProcesoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Tipo de proceso';
    }

    public function editar($id){
        $tipoProceso = TipoProceso::find($id);
        $this->titulo = 'Editar Tipo de proceso -'.optional($this->tipoProcesoT)->descripcion;
        $this->tipoProcesoId = $id;
        $this->form->descripcion = $tipoProceso->descripcion;
    }

    public function cambiarEstado($id){
        $tipoProceso = TipoProceso::find($id);
        $tipoProceso->estado = !$tipoProceso->estado;
        $tipoProceso->save();
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
        if($this->tipoProcesoId == null){
            $this->mensaje = "Tipo de proceso registrado exitosamente";
        }
        else{
            $this->mensaje = "Tipo de proceso actualizado exitosamente";
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
                text: "No se pudo registrar el tipo de proceso",
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
            $tipo = TipoProceso::updateOrCreate(
                [
                    'id'=>$this->tipoProcesoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
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
        $tipoProcesos = TipoProceso::when($this->busqueda != null, function ($query) {
                return $query->where('descripcion', 'like', '%' . $this->busqueda . '%');
            })->paginate(10);
        return view('livewire.financiero-contable.presupuestal.tipo-procesos.table',['tipoProcesos'=>$tipoProcesos]);
    }
}
