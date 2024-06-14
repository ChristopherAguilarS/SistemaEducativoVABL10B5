<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Responsables;

use App\Livewire\Forms\CrearResponsableForm;
use App\Models\Area;
use App\Models\Responsable;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanAnualTrabajo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearResponsableForm $form;
    public $titulo = 'Crear Nuevo Responsable';
    public $responsableT;
    public $responsableId;
    public $mensaje;
    public $plan_anuales;
    public $objetivos_estrategicos;
    public $areas;
    public $usuarios;

    public function hydrate()
    {
        $this->dispatch('data-change-event');
    }

    public function mount(){
        $this->areas = Area::where('estado', 1)->get();
        $this->usuarios = User::get();
        $this->form->tipo_responsable = 1;
    }

    #[On('agregar')]
    public function agregar(){
        $this->responsableId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Responsable';
    }

    public function editar($id){
        $responsable = Responsable::find($id);
        $this->titulo = 'Editar Responsable -'.optional($this->responsableT)->descripcion;
        $this->responsableId = $id;
        $this->form->descripcion = $responsable->descripcion;
        $this->form->tipo_responsable = $responsable->tipo_responsable;
        $this->form->responsable_id = $responsable->responsable_id;
        $this->form->responsables_id = $responsable->responsables_id;
    }

    public function cambiarEstado($id){
        $responsable = Responsable::find($id);
        $responsable->estado = !$responsable->estado;
        $responsable->save();
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
        if($this->responsableId == null){
            $this->mensaje = "Responsable registrado exitosamente";
        }
        else{
            $this->mensaje = "Responsable actualizado exitosamente";
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
                text: "No se pudo registrar el responsable",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function guardar(){
        $this->validate();
        try {
            $tipo = Responsable::updateOrCreate(
                [
                    'id'=>$this->responsableId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'tipo_responsable' => $this->form->tipo_responsable,
                    'responsable_id' => $this->form->responsable_id,
                    'responsables_id' => $this->form->responsables_id,
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
        $responsables = Responsable::paginate(10);
        return view('livewire.financiero-contable.presupuestal.responsables.table',['responsables'=>$responsables]);
    }
}
