<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Procesos;

use App\Livewire\Forms\CrearProcesoForm;
use App\Models\Proceso;
use App\Models\MacroProceso;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearProcesoForm $form;
    public $titulo = 'Crear Nuevo Proceso';
    public $procesoT;
    public $procesoId;
    public $mensaje;
    public $macro_procesos;
    public $macroProcesoId;
    public $busqueda;

    public function mount(){
        $this->macro_procesos = MacroProceso::where('estado',1)->get();
    }

    #[On('enviarMacroProcesoId')]
    public function obtenerMacroProcesoId($id){
        $this->macroProcesoId = $id;
        $this->render();
    }

    #[On('enviarBusqueda')]
    public function obtenerBusqueda($texto){
        $this->busqueda = $texto;
        $this->render();
    }

    #[On('agregar')]
    public function agregar(){
        $this->procesoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Macro Proceso';
        $this->form->macro_proceso_estado = false;
    }

    public function editar($id){
        $proceso = Proceso::find($id);
        $this->titulo = 'Editar Macro Proceso -'.optional($this->procesoT)->descripcion;
        $this->procesoId = $id;
        $this->form->descripcion = $proceso->descripcion;
        $this->form->macro_proceso_id = $proceso->macro_proceso_id;
    }

    public function cambiarEstado($id){
        $proceso = Proceso::find($id);
        $proceso->estado = !$proceso->estado;
        $proceso->save();
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
        if($this->procesoId == null){
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

    public function updatedFormMacroProcesoId(){
       // dd($this->form->macro_proceso_id);
       if($this->form->macro_proceso_estado == true){
            if($this->form->macro_proceso_id != null){
                $this->form->descripcion = MacroProceso::find($this->form->macro_proceso_id)->descripcion;
            }
            else{
                $this->form->descripcion = '';
            }
       }
    }

    public function guardar(){
        $this->form->validate();
        try {
            $macro = Proceso::updateOrCreate(
                [
                    'id'=>$this->procesoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'macro_proceso_id'=> $this->form->macro_proceso_id,
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
        $procesos = Proceso::when($this->macroProcesoId != null || $this->macroProcesoId !='', function ($query) {
            return $query->where('macro_proceso_id',$this->macroProcesoId);
        })
        ->when($this->busqueda != null, function ($query) {
                return $query->where('descripcion', 'like', '%' . $this->busqueda . '%');
            })->paginate(10);
        return view('livewire.financiero-contable.presupuestal.procesos.table',['procesos'=>$procesos]);
    }
}
