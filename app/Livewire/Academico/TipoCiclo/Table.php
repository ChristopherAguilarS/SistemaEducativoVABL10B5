<?php

namespace App\Livewire\Academico\TipoCiclo;

use App\Livewire\Forms\CrearTipoCicloForm;
use App\Models\TipoCiclo;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearTipoCicloForm $form;
    public $titulo = 'Crear Nuevo Tipo de Ciclo';
    public $tipoCicloT;
    public $tipoCicloId;
    public $mensaje;

    #[On('agregar')]
    public function agregar(){
        $this->tipoCicloId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Tipo de Ciclo';
    }

    public function editar($id){
        $tipoCiclo = TipoCiclo::find($id);
        $this->titulo = 'Editar Tipo de Ciclo -'.optional($this->tipoCicloT)->descripcion;
        $this->tipoCicloId = $id;
        $this->form->descripcion = $tipoCiclo->descripcion;
    }

    public function cambiarEstado($id){
        $tipoCiclo = TipoCiclo::find($id);
        $tipoCiclo->estado = !$tipoCiclo->estado;
        $tipoCiclo->save();
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
        if($this->tipoCicloId == null){
            $this->mensaje = "Tipo de Ciclo registrado exitosamente";
        }
        else{
            $this->mensaje = "Tipo de Ciclo actualizado exitosamente";
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
                text: "No se pudo registrar el tipo de ciclo",
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
            $tipo = TipoCiclo::updateOrCreate(
                [
                    'id'=>$this->tipoCicloId,
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
            dd($e);
            $this->mensajedeError();
        }
        
    }

    public function render()
    {
        $tipoCiclos = TipoCiclo::paginate(10);
        return view('livewire.academico.tipo-ciclo.table',['tipoCiclos'=>$tipoCiclos]);
    }
}
