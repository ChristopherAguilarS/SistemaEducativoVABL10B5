<?php

namespace App\Livewire\Academico\TipoIngreso;

use App\Livewire\Forms\CrearTipoIngresoForm;
use App\Models\TipoIngreso;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearTipoIngresoForm $form;
    public $titulo = 'Crear Nuevo Tipo Ingreso';
    public $tipoIngresoT;
    public $tipoIngresoId;
    public $mensaje;

    #[On('agregar')]
    public function agregar(){
        $this->tipoIngresoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Tipo Ingreso';
    }

    public function editar($id){
        $tipoIngreso = TipoIngreso::find($id);
        $this->titulo = 'Editar Tipo Ingreso -'.optional($this->tipoIngresoT)->descripcion;
        $this->tipoIngresoId = $id;
        $this->form->descripcion = $tipoIngreso->descripcion;
    }

    public function cambiarEstado($id){
        $tipoIngreso = TipoIngreso::find($id);
        $tipoIngreso->estado = !$tipoIngreso->estado;
        $tipoIngreso->save();
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
        if($this->tipoIngresoId == null){
            $this->mensaje = "Tipo de Ingreso registrado exitosamente";
        }
        else{
            $this->mensaje = "Tipo de Ingreso actualizado exitosamente";
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
                text: "No se pudo registrar el tipo de ingreso",
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
            $tipo = TipoIngreso::updateOrCreate(
                [
                    'id'=>$this->tipoIngresoId,
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
            $this->mensajedeError();
        }
        
    }

    public function render()
    {
        $tipoIngresos = TipoIngreso::paginate(10);
        return view('livewire.academico.tipo-ingreso.table',['tipoIngresos'=>$tipoIngresos]);
    }
}
