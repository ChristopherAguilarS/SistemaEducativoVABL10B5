<?php

namespace App\Livewire\FinancieroContable\Contabilidad\CajaBancos;

use App\Livewire\Forms\CrearMovimientoCajaBancoForm;
use App\Models\Cuenta;
use App\Models\MovimientoCajaBanco;
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
    public $movimientoId;
    public $movimientoT;
    public $titulo;
    public $cuentas;
    public $cuenta_id;
    public CrearMovimientoCajaBancoForm $form;

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
        $this->movimientoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo movimiento';
    }

    public function editar($id){
        $movimiento = MovimientoCajaBanco::find($id);
        $this->titulo = 'Editar Movimiento - '.optional($movimiento)->descripcion;
        $this->movimientoId = $id;
        $this->form->codigo = $movimiento->codigo;
        $this->form->descripcion = $movimiento->descripcion;
        $this->form->cuenta_id = $movimiento->cuenta_id;
        $this->form->fecha = $movimiento->fecha;
        $this->form->monto = $movimiento->monto;
        $this->form->tipo = $movimiento->tipo;
        $this->dispatch('cambiarSeleccion', id: $movimiento->cuenta_id);
    }

    public function cambiarEstado($id){
        $movimiento = MovimientoCajaBanco::find($id);
        $movimiento->estado = !$movimiento->estado;
        $movimiento->save();        
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
        if($this->movimientoId == null){
            $this->mensaje = "movimiento registrado exitosamente";
        }
        else{
            $this->mensaje = "movimiento actualizado exitosamente";
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
                text: "No se pudo registrar la movimiento",
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
            $tipo = MovimientoCajaBanco::updateOrCreate(
                [
                    'id'=>$this->movimientoId,
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
        $movimientos = MovimientoCajaBanco::when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })->paginate(10);
        return view('livewire.financiero-contable.contabilidad.caja-bancos.table',['movimientos'=>$movimientos]);
    }
}
