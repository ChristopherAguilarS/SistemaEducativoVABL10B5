<?php

namespace App\Livewire\Configuracion\Financiero\SubGenericaNivel1;

use App\Livewire\Forms\CrearSubGenericaNivel1Form;
use App\Models\Generica;
use App\Models\SubGenericaNivel1;
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
    public $genericaId;
    public $genericaT;
    public $titulo;
    public $genericas;
    public $generica_id;
    public CrearSubGenericaNivel1Form $form;

    public function mount(){
        $this->genericas = Generica::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->genericaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva SubGenerica';
    }

    public function editar($id){
        $SubGenerica = SubGenericaNivel1::find($id);
        $this->titulo = 'Editar SubGenerica - '.optional($SubGenerica)->descripcion;
        $this->genericaId = $id;
        $this->form->codigo = $SubGenerica->codigo;
        $this->form->descripcion = $SubGenerica->descripcion;
        $this->form->generica_id = $SubGenerica->generica_id;
        $this->dispatch('cambiarSeleccion', id: $SubGenerica->generica_id);
    }

    public function cambiarEstado($id){
        $SubGenerica = SubGenericaNivel1::find($id);
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
        if($this->genericaId == null){
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
            $tipo = SubGenericaNivel1::updateOrCreate(
                [
                    'id'=>$this->genericaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'generica_id' => $this->form->generica_id,
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
        $subgenericas = SubGenericaNivel1::paginate(10);
        return view('livewire.configuracion.financiero.sub-generica-nivel-1.table',['subgenericas'=>$subgenericas]);
    }
}
