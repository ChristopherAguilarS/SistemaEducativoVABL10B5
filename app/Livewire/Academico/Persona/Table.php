<?php

namespace App\Livewire\Academico\Persona;

use App\Livewire\Forms\CrearPersonaForm;
use App\Models\AñoAcademico;
use App\Models\Persona;
use App\Models\TipoPersona;
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
    public $personaId;
    public $personaT;
    public $titulo;
    public $tipo_personas;
    public $año_academicos;
    public $persona_id;
    public $año_academico_id;
    public CrearPersonaForm $form;

    public function mount(){
    }

    #[On('agregar')]
    public function agregar(){
        $this->personaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva Persona';
        $this->dispatch('anularSeleccion');
        $this->dispatch('anularSeleccionAño');
    }

    public function editar($id){
        $Persona = Persona::find($id);
        $this->titulo = 'Editar Persona - '.optional($Persona)->descripcion;
        $this->personaId = $id;
        $this->form->nombres = $Persona->nombres;
        $this->form->ape_pat = $Persona->ape_pat;
        $this->form->ape_mat = $Persona->ape_mat;
        $this->form->tipo_documento = $Persona->tipo_documento;
        $this->form->nro_documento = $Persona->nro_documento;
        $this->form->genero = $Persona->genero;
        $this->form->telefono = $Persona->telefono;
    }

    public function cambiarEstado($id){
        $Persona = Persona::find($id);
        $Persona->estado = !$Persona->estado;
        $Persona->save();
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
        if($this->personaId == null){
            $this->mensaje = "Persona registrado exitosamente";
        }
        else{
            $this->mensaje = "Persona actualizado exitosamente";
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
                text: "No se pudo registrar el Persona",
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
            $tipo = Persona::updateOrCreate(
                [
                    'id'=>$this->personaId,
                ],
                [
                    'nombres' => $this->form->nombres,
                    'ape_pat' => $this->form->ape_pat,
                    'ape_mat' => $this->form->ape_mat,
                    'tipo_documento' => $this->form->tipo_documento,
                    'nro_documento' => $this->form->nro_documento,
                    'genero' => $this->form->genero,
                    'telefono' => $this->form->telefono,
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
        $personas = Persona::paginate(10);
        return view('livewire.academico.persona.table',['personas'=>$personas]);
    }
}
