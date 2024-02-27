<?php

namespace App\Livewire\FinancieroContable\Contabilidad\AsientosContables;

use App\Livewire\Forms\CrearAsientoContableForm;
use App\Models\Cuenta;
use App\Models\AsientoContable;
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
    public $asientoId;
    public $asientoT;
    public $titulo;
    public $cuentas;
    public $cuenta_id;
    public CrearAsientoContableForm $form;

    public $fecha_inicio;
    public $fecha_fin;

    public function mount(){
        $this->cuentas = Cuenta::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('agregar')]
    public function agregar(){
        $this->asientoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo asiento';
    }

    public function editar($id){
        $asiento = AsientoContable::find($id);
        $this->titulo = 'Editar Asiento - '.optional($asiento)->descripcion;
        $this->asientoId = $id;
        $this->form->codigo = $asiento->codigo;
        $this->form->descripcion = $asiento->descripcion;
        $this->form->cuenta_id = $asiento->cuenta_id;
        $this->form->fecha = $asiento->fecha;
        $this->form->monto = $asiento->monto;
        $this->form->tipo = $asiento->tipo;
        $this->dispatch('cambiarSeleccion', id: $asiento->cuenta_id);
    }

    public function cambiarEstado($id){
        $asiento = AsientoContable::find($id);
        $asiento->estado = !$asiento->estado;
        $asiento->save();        
        $this->dispatch('actualizarCards');
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
        if($this->asientoId == null){
            $this->mensaje = "asiento registrado exitosamente";
        }
        else{
            $this->mensaje = "asiento actualizado exitosamente";
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
                text: "No se pudo registrar la asiento",
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
            $tipo = AsientoContable::updateOrCreate(
                [
                    'id'=>$this->asientoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'cuenta_id' => $this->form->cuenta_id,
                    'fecha' => $this->form->fecha,
                    'tipo' => $this->form->tipo,
                    'monto' => $this->form->monto,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
            $this->dispatch('actualizarCards');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
        
    }
    
    public function render()
    {
        $asientos = AsientoContable::when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })->paginate(10);
        return view('livewire.financiero-contable.contabilidad.asientos-contables.table',['asientos'=>$asientos]);
    }
}
