<?php

namespace App\Livewire\Configuracion\Financiero\EspecificaNivel2;

use App\Livewire\Forms\CrearEspecificaNivel2Form;
use App\Models\EspecificaNivel1;
use App\Models\EspecificaNivel2;
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
    public $especificaId;
    public $especificaT;
    public $titulo;
    public $especificas1;
    public $especifica_nivel_1_id;
    public CrearEspecificaNivel2Form $form;

    public function mount(){
        $this->especificas1 = EspecificaNivel1::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->especificaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva especifica';
    }

    public function editar($id){
        $especifica = EspecificaNivel2::find($id);
        $this->titulo = 'Editar Especifica - '.optional($especifica)->descripcion;
        $this->especificaId = $id;
        $this->form->codigo = $especifica->codigo;
        $this->form->descripcion = $especifica->descripcion;
        $this->form->especifica_nivel_1_id = $especifica->especifica_nivel_1_id;
        $this->dispatch('cambiarSeleccion', id: $especifica->especifica_nivel_1_id);
    }

    public function cambiarEstado($id){
        $especifica = EspecificaNivel2::find($id);
        $especifica->estado = !$especifica->estado;
        $especifica->save();
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
        if($this->especificaId == null){
            $this->mensaje = "especifica registrado exitosamente";
        }
        else{
            $this->mensaje = "especifica actualizado exitosamente";
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
                text: "No se pudo registrar la especifica",
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
            $tipo = EspecificaNivel2::updateOrCreate(
                [
                    'id'=>$this->especificaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'especifica_nivel_1_id' => $this->form->especifica_nivel_1_id,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
        
    }

    public function render()
    {
        $especificas = EspecificaNivel2::paginate(10);
        return view('livewire.configuracion.financiero.especifica-nivel-2.table',['especificas'=>$especificas]);
    }
}
