<?php

namespace App\Livewire\FinancieroContable\Contabilidad\CajaChica;

use App\Livewire\Forms\CrearMovimientoCajaChicaForm;
use App\Models\CategoriaMovimientoCajaChica;
use App\Models\Cuenta;
use App\Models\MovimientoCajaChica;
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
    public $categorias = [];
    public CrearMovimientoCajaChicaForm $form;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';

    public $fecha_inicio;
    public $fecha_fin;

    public function mount(){
        $this->cuentas = Cuenta::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('apertura')]
    public function apertura(){   
        $this->deshabilitar = 'disabled';    
        $this->apertura = true; 
        $this->cierre = false;
        $this->categorias = CategoriaMovimientoCajaChica::all();
        $this->form->tipo = 1;
        $this->movimientoId = null;
        $this->titulo = 'Apertura de Caja Chica';         
        $this->updatedFormTipo();
        $this->form->categoria_id = 1;
    }

    #[On('cierre')]
    public function cierre(){   
        $this->deshabilitar = 'disabled';    
        $this->cierre = true;   
        $this->apertura = false;
        $this->categorias = CategoriaMovimientoCajaChica::all();
        $this->form->tipo = 2;
        $this->movimientoId = null;
        $this->titulo = 'Cierre de Caja Chica';         
        $this->updatedFormTipo();
        $this->form->categoria_id = 8;
        $this->form->comprobante = '-';
        $this->form->monto = 0;
    }

    public function updatedFormTipo(){
        if($this->form->tipo != null){
            $this->categorias = CategoriaMovimientoCajaChica::where('estado',1)->whereNotIn('id',[1,8])->where('tipo',$this->form->tipo)->get();
        }
        else{
            $this->categorias = new CategoriaMovimientoCajaChica();
        }
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('agregar')]
    public function agregar(){
        $this->movimientoId = null;
        $this->deshabilitar = '';
        $this->apertura = false;
        $this->cierre = false;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo movimiento';
    }

    public function editar($id){
        $movimiento = MovimientoCajaChica::find($id);
        $this->titulo = 'Editar Movimiento - '.optional($movimiento)->descripcion;
        $this->movimientoId = $id;
        $this->form->descripcion = $movimiento->descripcion;
        $this->form->cuenta_id = $movimiento->cuenta_id;
        $this->form->fecha = $movimiento->fecha;
        $this->form->comprobante = $movimiento->comprobante;
        $this->form->categoria_id = $movimiento->categoria_id;
        $this->form->descripcion_categoria = $movimiento->descripcion_categoria;
        $this->form->monto = $movimiento->monto;
        $this->form->tipo = $movimiento->tipo;
        $this->dispatch('cambiarSeleccion', id: $movimiento->cuenta_id);
    }

    public function cambiarEstado($id){
        $movimiento = MovimientoCajaChica::find($id);
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
        $mId = null;
        if($this->form->categoria_id != 1){
            $mAC = MovimientoCajaChica::where('categoria_id',1)->where('estado',1)->first();
            $mId = $mAC->id;
        }
        try {
            $tipo = MovimientoCajaChica::updateOrCreate(
                [
                    'id'=>$this->movimientoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'cuenta_id' => $this->form->cuenta_id,
                    'fecha' => $this->form->fecha,
                    'tipo' => $this->form->tipo,
                    'categoria_id' => $this->form->categoria_id,
                    'comprobante' => $this->form->comprobante,
                    'descripcion_categoria' => $this->form->descripcion_categoria,
                    'movimiento_apertura_id' => $mId,
                    'monto' => $this->form->monto,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();
            $this->limpiarCampos();
            $this->cerrarModal();
            $this->dispatch('actualizarCards');
            if($tipo->categoria_id == 8){
                $mAC = MovimientoCajaChica::where('categoria_id',1)->where('estado',1)->first();
                $mAC->estado = 2;
                $mAC->save();
            }
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
        
    }
    
    public function render()
    {
        $movimientos = MovimientoCajaChica::when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })->paginate(10);
        return view('livewire.financiero-contable.contabilidad.caja-chica.table',['movimientos'=>$movimientos]);
    }
}
