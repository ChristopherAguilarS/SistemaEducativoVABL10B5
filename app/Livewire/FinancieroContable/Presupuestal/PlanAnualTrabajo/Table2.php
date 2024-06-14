<?php

namespace App\Livewire\FinancieroContable\Presupuestal\PlanAnualTrabajo;

use App\Livewire\Forms\CrearPlanAnualTrabajoForm;
use App\Models\PlanAnualTrabajo;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table2 extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearPlanAnualTrabajoForm $form;
    public $titulo = 'Crear Nuevo Plan Anual de Trabajo';
    public $planAnualTrabajoT;
    public $planAnualTrabajoId;
    public $mensaje;
    public $años = ['2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033'];

    #[On('agregar')]
    public function agregar(){
        $this->planAnualTrabajoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Plan Anual de Trabajo';
    }

    public function editar($id){
        $planAnualTrabajo = PlanAnualTrabajo::find($id);
        $this->titulo = 'Editar Plan Anual de Trabajo -'.optional($this->planAnualTrabajoT)->descripcion;
        $this->planAnualTrabajoId = $id;
        $this->form->año = $planAnualTrabajo->año;
        $this->form->nombre = $planAnualTrabajo->nombre;
        $this->form->ruc = $planAnualTrabajo->ruc;
        $this->form->resolucion = $planAnualTrabajo->resolucion;
        $this->form->tipo_gestion = $planAnualTrabajo->tipo_gestion;
        $this->form->direccion = $planAnualTrabajo->direccion;
        $this->form->lista_servicios = $planAnualTrabajo->lista_servicios;
        $this->form->nombre_director = $planAnualTrabajo->nombre_director;
    }

    public function cambiarEstado($id){
        $planAnualTrabajo = PlanAnualTrabajo::find($id);
        $planAnualTrabajo->estado = !$planAnualTrabajo->estado;
        $planAnualTrabajo->save();
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
        if($this->planAnualTrabajoId == null){
            $this->mensaje = "Plan Anual de Trabajo registrado exitosamente";
        }
        else{
            $this->mensaje = "Plan Anual de Trabajo actualizado exitosamente";
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
                text: "No se pudo registrar el plan anual de trabajo",
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
            $tipo = PlanAnualTrabajo::updateOrCreate(
                [
                    'id'=>$this->planAnualTrabajoId,
                ],
                [
                    'año' => $this->form->año,                    
                    'nombre' => $this->form->nombre,                    
                    'ruc' => $this->form->ruc,                    
                    'resolucion' => $this->form->resolucion,                    
                    'tipo_gestion' => $this->form->tipo_gestion,                    
                    'direccion' => $this->form->direccion,                    
                    'lista_servicios' => $this->form->lista_servicios,
                    'nombre_director' => $this->form->nombre_director,
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
        $planAnualTrabajos = PlanAnualTrabajo::paginate(10);
        return view('livewire.financiero-contable.presupuestal.plan-anual-trabajo.table2',['planAnualTrabajos'=>$planAnualTrabajos]);
    }
}
