<?php

namespace App\Livewire\Configuracion\Financiero\EspecificaNivel1;

use App\Livewire\Forms\CrearEspecificaNivel1Form;
use App\Models\EspecificaNivel1;
use App\Models\SubGenericaNivel2;
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
    public $subgenericas;
    public $sub_generica_nivel_2_id;
    public CrearEspecificaNivel1Form $form;

    public function mount(){
        $this->subgenericas = SubGenericaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->especificaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva especifica';
    }

    public function editar($id){
        $especifica = EspecificaNivel1::find($id);
        $this->titulo = 'Editar Especifica - '.optional($especifica)->descripcion;
        $this->especificaId = $id;
        $this->form->codigo = $especifica->codigo;
        $this->form->descripcion = $especifica->descripcion;
        $this->form->sub_generica_nivel_2_id = $especifica->sub_generica_nivel_2_id;
        $this->dispatch('cambiarSeleccion', id: $especifica->sub_generica_nivel_2_id);
    }

    public function cambiarEstado($id){
        $especifica = EspecificaNivel1::find($id);
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
            $tipo = EspecificaNivel1::updateOrCreate(
                [
                    'id'=>$this->especificaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'sub_generica_nivel_2_id' => $this->form->sub_generica_nivel_2_id,
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
        $especificas = EspecificaNivel1::paginate(10);
        return view('livewire.configuracion.financiero.especifica-nivel-1.table',['especificas'=>$especificas]);
    }
}
