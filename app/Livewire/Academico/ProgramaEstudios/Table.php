<?php

namespace App\Livewire\Academico\ProgramaEstudios;

use App\Livewire\Forms\CrearProgramaEstudioForm;
use App\Models\ProgramaEstudio;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearProgramaEstudioForm $form;
    public $titulo = 'Crear Nuevo Tipo Ingreso';
    public $programaEstudioT;
    public $programaEstudioId;
    public $mensaje;

    #[On('agregar')]
    public function agregar(){
        $this->programaEstudioId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Tipo Ingreso';
    }

    public function editar($id){
        $programaEstudio = ProgramaEstudio::find($id);
        $this->titulo = 'Editar Tipo Ingreso -'.optional($this->programaEstudioT)->descripcion;
        $this->programaEstudioId = $id;
        $this->form->descripcion = $programaEstudio->descripcion;
    }

    public function cambiarEstado($id){
        $programaEstudio = ProgramaEstudio::find($id);
        $programaEstudio->estado = !$programaEstudio->estado;
        $programaEstudio->save();
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
        if($this->programaEstudioId == null){
            $this->mensaje = "Programa de Estudio registrado exitosamente";
        }
        else{
            $this->mensaje = "Programa de Estudio actualizado exitosamente";
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
                text: "No se pudo registrar el programa de estudio",
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
            $tipo = ProgramaEstudio::updateOrCreate(
                [
                    'id'=>$this->programaEstudioId,
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
        $programaEstudios = ProgramaEstudio::paginate(10);
        return view('livewire.academico.programa-estudios.table',['programaEstudios'=>$programaEstudios]);
    }
}
