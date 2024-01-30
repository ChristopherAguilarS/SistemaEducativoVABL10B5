<?php

namespace App\Livewire\Configuracion\Financiero\SubGenericaNivel2;

use App\Livewire\Forms\CrearSubGenericaNivel2Form;
use App\Models\SubGenericaNivel1;
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
    public $subgenericaId;
    public $subgenericaT;
    public $titulo;
    public $subgenericas;
    public $sub_generica_nivel_1_id;
    public CrearSubGenericaNivel2Form $form;

    public function mount(){
        $this->subgenericas = SubGenericaNivel1::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->subgenericaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva SubGenerica';
    }

    public function editar($id){
        $SubGenerica = SubGenericaNivel2::find($id);
        $this->titulo = 'Editar SubGenerica - '.optional($SubGenerica)->descripcion;
        $this->subgenericaId = $id;
        $this->form->codigo = $SubGenerica->codigo;
        $this->form->descripcion = $SubGenerica->descripcion;
        $this->form->sub_generica_nivel_1_id = $SubGenerica->sub_generica_nivel_1_id;
        $this->dispatch('cambiarSeleccion', id: $SubGenerica->sub_generica_nivel_1_id);
    }

    public function cambiarEstado($id){
        $SubGenerica = SubGenericaNivel2::find($id);
        $SubGenerica->estado = !$SubGenerica->estado;
        $SubGenerica->save();
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
        if($this->subgenericaId == null){
            $this->mensaje = "SubGenerica registrado exitosamente";
        }
        else{
            $this->mensaje = "SubGenerica actualizado exitosamente";
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
                text: "No se pudo registrar la SubGenerica",
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
            $tipo = SubGenericaNivel2::updateOrCreate(
                [
                    'id'=>$this->subgenericaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'sub_generica_nivel_1_id' => $this->form->sub_generica_nivel_1_id,
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
        $subgenericas2 = SubGenericaNivel2::paginate(10);
        return view('livewire.configuracion.financiero.sub-generica-nivel-2.table',['subgenericas2'=>$subgenericas2]);
    }
}
