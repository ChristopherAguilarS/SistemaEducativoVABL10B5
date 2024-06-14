<?php

namespace App\Livewire\FinancieroContable\Contabilidad\MovimientoCajaChica;

use App\Livewire\Forms\CrearAperturaCajaChicaForm;
use App\Livewire\Forms\CrearMovimientoCajaChicaForm;
use App\Models\CajaChica;
use App\Models\CategoriaMovimientoCajaChica;
use App\Models\Cuenta;
use App\Models\EspecificaNivel2;
use App\Models\Indicador;
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
    public $tituloApertura;
    public $indicadores;
    public $indicador_id;
    public $categorias = [];
    public CrearMovimientoCajaChicaForm $form;
    public CrearAperturaCajaChicaForm $formApertura;
    public $deshabilitar = '';
    public $apertura = '';
    public $cierre = '';

    public $fecha_inicio;
    public $fecha_fin;

    public $caja_seleccionada_id;
    public $especificas2;

    public function mount(){
        $this->indicadores = Indicador::where('estado',1)->orderBy('descripcion')->get();
        $this->especificas2 = EspecificaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('apertura')]
    public function apertura($caja_seleccionada){   
        /*$this->deshabilitar = 'disabled';    
        $this->apertura = true; 
        $this->cierre = false;
        $this->categorias = CategoriaMovimientoCajaChica::all();
        $this->form->tipo_movimiento = 1;
        $this->movimientoId = null;
        $this->titulo = 'Apertura de Caja Chica';         
        $this->updatedFormTipo();
        $this->form->categoria_id = 1;*/
        $this->caja_seleccionada_id = $caja_seleccionada;
        $this->tituloApertura = 'Crear Movimiento de Apertura';
    }

    #[On('cierre')]
    public function cierre(){   
        $this->deshabilitar = 'disabled';    
        $this->cierre = true;   
        $this->apertura = false;
        $this->categorias = CategoriaMovimientoCajaChica::all();
        $this->form->tipo_movimiento = 2;
        $this->movimientoId = null;
        $this->titulo = 'Cierre de Caja Chica';         
        $this->updatedFormTipoMovimiento();
        $this->form->categoria_id = 8;
        $this->form->comprobante = '-';
        $this->form->monto = 0;
    }

    public function updatedFormTipoMovimiento(){
        if($this->form->tipo_movimiento != null){
            $this->categorias = CategoriaMovimientoCajaChica::where('estado',1)->whereNotIn('id',[1,8])->where('tipo',$this->form->tipo_movimiento)->get();
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
        $this->form->indicador_id = $movimiento->indicador_id;
        $this->form->fecha = $movimiento->fecha;
        $this->form->comprobante = $movimiento->comprobante;
        $this->form->categoria_id = $movimiento->categoria_id;
        $this->form->monto = $movimiento->monto;
        $this->form->tipo_movimiento = $movimiento->tipo_movimiento;
        $this->dispatch('cambiarSeleccion', id: $movimiento->indicador_id);
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

    public function limpiarCamposApertura(){
        $this->formApertura->limpiarCampos();
    }

    #[Js] 
    public function cerrarModal()
    {
       
        $this->js(<<<'JS'
            $('#myModal').modal('hide')
        JS);
    }

    #[Js] 
    public function cerrarModalApertura()
    {
       
        $this->js(<<<'JS'
            $('#myModalApertura').modal('hide')
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

    public function guardarApertura(){
        $this->formApertura->validate();
        $movimiento = MovimientoCajaChica::updateOrCreate(
            [
                'id'=>$this->movimientoId,
            ],
            [
                'caja_chica_id' => $this->caja_seleccionada_id,
                'fecha' => $this->formApertura->fecha_creacion,
                'tipo_movimiento' => 1,
                'categoria_movimiento_id' => 1,
                'descripcion' => 'Apertura de Caja Chica',
                'monto' => $this->formApertura->monto_inicial,
                'indicador_id' => null,
                'responsable_id' => Auth::user()->id,
                'tipo_desembolso' => 1,
                'nro_desmbolso' => $this->formApertura->decreto,
                'estado' => 1,
                'created_by' => Auth::user()->id
            ]);
        $this->mensajedeExito();
        $this->limpiarCamposApertura();
        $this->cerrarModalApertura();
        //$this->dispatch('actualizarCards');
        if($movimiento->categoria_movimiento_id == 1){
            $caja = CajaChica::where('id',$this->caja_seleccionada_id)->where('estado',1)->first();
            $caja->tipo_proceso = 2;
            $caja->save();
        }
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
                    'caja_chica_id' => $this->form->descripcion,
                    'indicador_id' => $this->form->indicador_id,
                    'fecha' => $this->form->fecha,
                    'tipo_movimiento' => $this->form->tipo_movimiento,
                    'categoria_id' => $this->form->categoria_id,
                    'comprobante' => $this->form->comprobante,
                    'descripcion' => $this->form->descripcion,
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
        return view('livewire.financiero-contable.contabilidad.movimiento-caja-chica.table',['movimientos'=>$movimientos]);
    }
}
