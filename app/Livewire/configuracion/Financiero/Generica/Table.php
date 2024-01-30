<?php

namespace App\Livewire\Configuracion\Financiero\Generica;

use App\Livewire\Forms\CrearGenericaForm;
use App\Models\Generica;
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
    public $genericaId;
    public $genericaT;
    public $titulo;
    public $tipo_transacciones;
    public $tipo_transaccion_id;
    public CrearGenericaForm $form;

    public function mount(){
        $this->tipo_transacciones = TipoTransaccion::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->genericaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva Generica';
        $this->dispatch('anularSeleccion');
        $this->form->limpiarCampos();
    }

    public function editar($id){
        $Generica = Generica::find($id);
        $this->titulo = 'Editar Generica - '.optional($Generica)->descripcion;
        $this->genericaId = $id;
        $this->form->codigo = $Generica->codigo;
        $this->form->descripcion = $Generica->descripcion;
        $this->form->tipo_transaccion_id = $Generica->tipo_transaccion_id;
        $this->dispatch('cambiarSeleccion', id: $Generica->tipo_transaccion_id);
    }

    public function cambiarEstado($id){
        $Generica = Generica::find($id);
        $Generica->estado = !$Generica->estado;
        $Generica->save();
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
            $this->mensaje = "Generica registrado exitosamente";
        }
        else{
            $this->mensaje = "Generica actualizado exitosamente";
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
                text: "No se pudo registrar la generica",
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
            $tipo = Generica::updateOrCreate(
                [
                    'id'=>$this->genericaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'tipo_transaccion_id' => $this->form->tipo_transaccion_id,
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
        $genericas = Generica::paginate(10);
        return view('livewire.configuracion.financiero.generica.table',['genericas'=>$genericas]);
    }
}
