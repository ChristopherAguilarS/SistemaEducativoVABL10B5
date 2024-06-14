<?php

namespace App\Livewire\FinancieroContable\Contabilidad\AsientosContables;

use App\Livewire\Forms\CrearAsientoContableForm;
use App\Livewire\Forms\CrearDetalleAsientoContableForm;
use App\Models\Cuenta;
use App\Models\AsientoContable;
use App\Models\DetalleAsientoContable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public $tituloCuenta;
    public $cuentas;
    public $cuenta_id;
    public $detalles;
    public $tipo;
    public CrearAsientoContableForm $form;
    public CrearDetalleAsientoContableForm $dform;
    public $totalDebe = 0;
    public $totalHaber = 0;

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
        $this->titulo = 'Crear Nueva asiento';
    }

    public function agregarDebe(){
        $this->tituloCuenta = 'Agregar Cuenta al Debe';
        $this->tipo = 0;
    }

    public function agregarHaber(){
        $this->tituloCuenta = 'Agregar Cuenta al Haber';
        $this->tipo = 1;
    }

    public function editar($id){
        $asiento = AsientoContable::find($id);
        $this->titulo = 'Editar Asiento - '.optional($asiento)->descripcion;
        $this->asientoId = $id;
        $this->form->descripcion = $asiento->descripcion;
        $this->form->fecha = $asiento->fecha;
        $detallesD = DetalleAsientoContable::where('asiento_id',$asiento->id)->where('tipo',0)->get();
        $detallesDT = [];
        foreach ($detallesD as $detalle) {
            $a = [];
            $a['descripcion'] = $detalle->descripcion;
            $a['asiento_id'] = $detalle->asiento_id;
            $a['cuenta_id'] = $detalle->cuenta_id;
            $a['monto'] = $detalle->monto;
            $a['tipo'] = $detalle->tipo;
            $a['fecha'] = $detalle->fecha;
            array_push($detallesDT,$a);
        }
        $this->form->detalleDebe = $detallesDT;
        $detallesH = DetalleAsientoContable::where('asiento_id',$asiento->id)->where('tipo',1)->get();
        $detallesHT = [];
        foreach ($detallesH as $detalle) {
            $a = [];
            $a['descripcion'] = $detalle->descripcion;
            $a['asiento_id'] = $detalle->asiento_id;
            $a['cuenta_id'] = $detalle->cuenta_id;
            $a['monto'] = $detalle->monto;
            $a['tipo'] = $detalle->tipo;
            $a['fecha'] = $detalle->fecha;
            array_push($detallesHT,$a);
        }
        $this->form->detalleDebe = $detallesHT;
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
    public function cerrarModalCuenta()
    {
       
        $this->js(<<<'JS'
            $('#myModalCuenta').modal('hide')
            $('#myModal').modal('show')
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

    #[Js] 
    public function mensajeCuentaExistente()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "La cuenta ya esta agregada",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajeExitoCuenta()
    {
        $this->js(<<<'JS'
            Toastify({
                avatar: "",
                text: "Se agrego la cuenta exitosamente",
                className: "info"
            }).showToast();
        JS);
    }

    public function eliminarCuentaHaber($index){
        unset($this->form->detalleHaber[$index-1]);
        $this->actualizarSumaHaber();
    }

    public function eliminarCuentaDebe($index){
        unset($this->form->detalleDebe[$index-1]);
        $this->actualizarSumaDebe();
    }

    public function actualizarSumaDebe(){
        $detalle = collect($this->form->detalleDebe);
        $this->totalDebe = $detalle->sum('monto');
    }

    public function actualizarSumaHaber(){
        $detalle = collect($this->form->detalleHaber);
        $this->totalHaber = $detalle->sum('monto');
    }

    public function guardarCuenta(){
        $this->dform->validate();
        $a = [];
        $a['id'] = null;
        $a['descripcion'] = null;
        $a['cuenta_id']= $this->dform->cuenta_id;
        $cuenta = Cuenta::find($this->dform->cuenta_id);
        $nombre = optional($cuenta)->codigo.' - '.optional($cuenta)->descripcion;
        $a['cuenta'] = $nombre;
        $a['monto'] = $this->dform->monto;
        if($this->tipo == 1){
            $ids = array_column($this->form->detalleHaber, 'cuenta_id');
            if (in_array($this->dform->cuenta_id, $ids)) {
                $this->mensajeCuentaExistente();
            }
            else{
                array_push($this->form->detalleHaber,$a);
                $this->mensajeExitoCuenta();
                $this->dform->limpiarCampos();
                $this->actualizarSumaHaber();
                $this->cerrarModalCuenta();
            }
        }
        else{
            $ids = array_column($this->form->detalleDebe, 'cuenta_id');
            if (in_array($this->dform->cuenta_id, $ids)) {
                $this->mensajeCuentaExistente();
            }
            else{
                array_push($this->form->detalleDebe,$a);
                $this->mensajeExitoCuenta();
                $this->dform->limpiarCampos();
                $this->actualizarSumaDebe();
                $this->cerrarModalCuenta();
            }
            
        }
        
    }

    public function guardar(){
        $this->form->validate();
        try {
            DB::beginTransaction();
            $asiento = AsientoContable::updateOrCreate(
                [
                    'id'=>$this->asientoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'fecha' => $this->form->fecha,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            foreach ($this->form->detalleDebe as $detalle) {
                $dasiento = DetalleAsientoContable::updateOrCreate(
                    [
                        'id'=>$detalle['id'],
                    ],
                    [
                        'descripcion' => $detalle['descripcion'],
                        'asiento_id' => $asiento->id,
                        'cuenta_id' => $detalle['cuenta_id'],
                        'monto' => $detalle['monto'],
                        'tipo' => 0,
                        'estado' => 1,
                        'created_by' => Auth::user()->id
                    ]);
            }
            foreach ($this->form->detalleHaber as $detalle) {
                $dasiento = DetalleAsientoContable::updateOrCreate(
                    [
                        'id'=>$detalle['id'],
                    ],
                    [
                        'descripcion' => $detalle['descripcion'],
                        'asiento_id' => $asiento->id,
                        'cuenta_id' => $detalle['cuenta_id'],
                        'monto' => $detalle['monto'],
                        'tipo' => 1,
                        'estado' => 1,
                        'created_by' => Auth::user()->id
                    ]);
            }
            DB::commit();
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            DB::rollBack();
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
