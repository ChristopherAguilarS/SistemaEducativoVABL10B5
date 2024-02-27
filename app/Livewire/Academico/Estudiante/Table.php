<?php

namespace App\Livewire\Academico\Estudiante;

use App\Livewire\Forms\CrearEstudianteForm;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\TipoTransaccion;
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
    public $estudianteId;
    public $estudianteT;
    public $titulo;
    public $persona_id;
    public $personas;
    public CrearEstudianteForm $form;

    public function mount(){
        $this->personas = Persona::where('estado',1)->orderBy('ape_pat')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->estudianteId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva Estudiante';
        $this->dispatch('anularSeleccion');
        $this->form->limpiarCampos();
    }

    public function editar($id){
        $Estudiante = Estudiante::find($id);
        $this->titulo = 'Editar Estudiante - '.optional($Estudiante)->descripcion;
        $this->estudianteId = $id;
        $this->form->nro_estudiante = $Estudiante->nro_estudiante;
        $this->form->persona_id = $Estudiante->persona_id;
        $this->dispatch('cambiarSeleccion', id: $Estudiante->tipo_transaccion_id);
    }

    public function cambiarEstado($id){
        $Estudiante = Estudiante::find($id);
        $Estudiante->estado = !$Estudiante->estado;
        $Estudiante->save();
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
        if($this->estudianteId == null){
            $this->mensaje = "Estudiante registrado exitosamente";
        }
        else{
            $this->mensaje = "Estudiante actualizado exitosamente";
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
                text: "No se pudo registrar la estudiante",
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
            $tipo = Estudiante::updateOrCreate(
                [
                    'id'=>$this->estudianteId,
                ],
                [
                    'nro_estudiante' => $this->form->nro_estudiante,
                    'persona_id' => $this->form->persona_id,
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
        $estudiantes = Estudiante::paginate(10);
        return view('livewire.academico.estudiante.table',['estudiantes'=>$estudiantes]);
    }
}
