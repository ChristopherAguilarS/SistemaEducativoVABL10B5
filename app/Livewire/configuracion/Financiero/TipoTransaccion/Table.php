<?php

namespace App\Livewire\Configuracion\Financiero\TipoTransaccion;

use App\Livewire\Forms\CrearTipoTransaccionForm;
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
    public CrearTipoTransaccionForm $form;
    public $titulo = 'Crear Nuevo Tipo Transaccion';
    public $tipoTransaccionT;
    public $tipoTransaccionId;
    public $mensaje;

    #[On('agregar')]
    public function agregar(){
        $this->tipoTransaccionId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Tipo Transaccion';
    }

    public function editar($id){
        $tipoTransaccion = TipoTransaccion::find($id);
        $this->titulo = 'Editar Tipo Transaccion -'.optional($this->tipoTransaccionT)->descripcion;
        $this->tipoTransaccionId = $id;
        $this->form->codigo = $tipoTransaccion->codigo;
        $this->form->descripcion = $tipoTransaccion->descripcion;
    }

    public function cambiarEstado($id){
        $tipoTransaccion = TipoTransaccion::find($id);
        $tipoTransaccion->estado = !$tipoTransaccion->estado;
        $tipoTransaccion->save();
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
        if($this->tipoTransaccionId == null){
            $this->mensaje = "Tipo de Transaccion registrado exitosamente";
        }
        else{
            $this->mensaje = "Tipo de Transaccion actualizado exitosamente";
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
                text: "No se pudo registrar el tipo de transaccion",
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
            $tipo = TipoTransaccion::updateOrCreate(
                [
                    'id'=>$this->tipoTransaccionId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
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
        $tipoTransacciones = TipoTransaccion::paginate(10);
        return view('livewire.configuracion.financiero.tipo-transaccion.table',['tipoTransacciones'=>$tipoTransacciones]);
    }
}
