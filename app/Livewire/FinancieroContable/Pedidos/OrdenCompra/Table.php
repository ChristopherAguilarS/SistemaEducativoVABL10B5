<?php

namespace App\Livewire\FinancieroContable\Pedidos\OrdenCompra;

use App\Livewire\Forms\CrearDetallePedidoForm;
use App\Livewire\Forms\CrearDetalleRequerimientoForm;
use App\Livewire\Forms\CrearPedidoForm;
use App\Livewire\Forms\CrearRequerimientoCajaBancoForm;
use App\Livewire\Forms\CrearRequerimientoForm;
use App\Models\ActividadOperativa;
use App\Models\Cuenta;
use App\Models\FinancieroContable\CatalogoProveedor;
use App\Models\Indicador;
use App\Models\Item;
use App\Models\ObjetivoEstrategico;
use App\Models\Pedido;
use App\Models\RecursosHumanos\Persona;
use App\Models\Requerimiento;
use App\Models\RequerimientoCajaBanco;
use App\Models\RequerimientoItem;
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
    public $requerimientoId;
    public $requerimientoT;
    public $titulo;
    public $tituloDetalle;
    public $indicadores = [];
    public $objetivos_estrategicos;
    public $objetivo_estrategico_id;
    public $actividad_operativa_id;
    public $actividades_operativas = [];
    public $indicador_id;
    public $indicadorP;
    public CrearPedidoForm $form;
    public CrearDetallePedidoForm $formDetalle;
    public $bienes;
    public $bienId;

    public $fecha_inicio;
    public $fecha_fin;
    public $selectedOption;
    public $items;
    public $proveedores;

    public function mount(){
        $this->indicadores = Indicador::where('estado',1)->orderBy('descripcion')->get();
        $this->proveedores = CatalogoProveedor::where('estado',1)->get();
        $this->updatedFormTipoPedido();
        $this->bienes = [];
    }

    public function updatedFormTipoPedido(){
        if($this->form->tipo_pedido == '2'){
            $this->items = Item::whereHas('familia.clase.grupo', function ($query) {
                $query->where('tipo_adquisicion_id', 2);
            })->take(10)->get();
        }
        else{
            $this->items = Item::whereHas('familia.clase.grupo', function ($query) {
                $query->where('tipo_adquisicion_id', 1);
            })->take(10)->get();
        }
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('agregar')]
    public function agregar(){
        $this->requerimientoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Pedido';
    }

    public function editar($id){
        $requerimiento = Requerimiento::find($id);
        $this->titulo = 'Editar Requerimiento - '.optional($requerimiento)->descripcion;
        $this->requerimientoId = $id;
        $this->form->descripcion = $requerimiento->descripcion;
        $this->form->responsable_id = $requerimiento->responsable_id;
        $this->form->fecha_registro_requerimiento = $requerimiento->fecha_registro_requerimiento;
        $this->form->comentarios = $requerimiento->comentarios;
        $this->form->tipo_pedido = $requerimiento->tipo_pedido;
        $this->dispatch('cambiarSeleccion', id: $requerimiento->cuenta_id);
    }

    public function abrirRequerimiento($id){
        $this->requerimientoId = $id;
        $requerimiento = Requerimiento::find($id);
        $this->indicadorP = Indicador::find($requerimiento->indicador_id);
        $this->form->requerimiento_id = $requerimiento->id;
        $this->form->descripcion = $requerimiento->descripcion;
        $this->form->tipo_pedido = $requerimiento->tipo_pedido;
        $bienes = RequerimientoItem::where('requerimiento_id',$this->requerimientoId)->where('estado',1)->get();
        foreach ($bienes as $key => $bien) {
            $this->bienes[$key]['item_id'] = $bien->item_id;
            $this->bienes[$key]['cantidad_solicitada'] = $bien->cantidad_solicitada;
            $this->bienes[$key]['cantidad_presupuestada'] = $bien->cantidad_solicitada;
            $this->bienes[$key]['precio'] = 0;
            $this->bienes[$key]['importe'] = 0;
            $this->bienes[$key]['comentarios'] = "";
            $this->bienes[$key]['especificaciones'] = [];
        }
    }

    public function abrirCaracteristica($id){
        $this->bienId = $id;
        $this->formDetalle->limpiarCampos();
    }

    public function guardarDetalle(){
        $this->formDetalle->validate();
        $a = [];
        $a['tipo_caracteristica'] = $this->formDetalle->tipo_caracteristica;
        $a['descripcion'] = $this->formDetalle->descripcion;
        array_push($this->bienes[$this->bienId]['especificaciones'],$a);
    }

    public function mostrarUnidad($id){
        $bien = Item::find($id);
        if($bien != null){
            return $bien->unidad_medida->descripcion;
        }
    }

    public function mostrarDescripcion($id){
        $bien = Item::find($id);
        if($bien != null){
            return $bien->descripcion;
        }
    }

    public function mostrarCodigo($id){
        $bien = Item::find($id);
        if($bien != null){
            return $bien->familia->clase->grupo->codigo.'.'.$bien->familia->clase->codigo.'.'.$bien->familia->codigo.'.'.$bien->codigo;
        }
    }

    public function cambiarEstado($id){
        $requerimiento = Requerimiento::find($id);
        $requerimiento->estado = !$requerimiento->estado;
        $requerimiento->save();        
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
    public function cerrarModalDetalle()
    {
       
        $this->js(<<<'JS'
            $('#myModalDetalle').modal('hide')
        JS);
    }

    #[Js] 
    public function abrirModal()
    {
       
        $this->js(<<<'JS'
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
        if($this->requerimientoId == null){
            $this->mensaje = "requerimiento registrado exitosamente";
        }
        else{
            $this->mensaje = "requerimiento actualizado exitosamente";
        }
        $this->js(<<<'JS'
            Toastify({
                text: $wire.mensaje,
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeExitoDetalle()
    {
        if($this->requerimientoId == null){
            $this->mensaje = "item agregado exitosamente";
        }
        else{
            $this->mensaje = "item actualizado exitosamente";
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
                text: "No se pudo registrar la requerimiento",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }



    public function guardar(){
        $this->form->validate();
        $pedido = Pedido::latest()->first();
        if($pedido != null){
            $nro_pedido = $pedido->id + 1;
        }
        else{
            $nro_pedido = 0;
        }
        try {
            $pedidoT = Pedido::updateOrCreate(
                [
                    'id'=>$this->requerimientoId,
                ],
                [
                    'nro_pedido' => 'R'.$nro_pedido,
                    'descripcion' => $this->form->descripcion,
                    'responsable_id' => $this->form->responsable_id,
                    'indicador_id' => $this->form->indicador_id,
                    'fecha_registro_requerimiento' => $this->form->fecha_registro_requerimiento,
                    'tipo_pedido' => $this->form->tipo_pedido,
                    'estado_proceso' => 1,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            foreach ($this->bienes as $key => $bien) {
                $requerimientoTemp = RequerimientoItem::where('requerimiento_id',$requerimiento->id)->where('item_id',$bien['item_id'])->where('estado',1)->first();
                $bienT = RequerimientoItem::updateorCreate(
                    [
                        'id'=>optional($requerimientoTemp)->id,
                    ],
                    [
                        'item_id' => $bien['item_id'],
                        'requerimiento_id' => $requerimiento->id,
                        'cantidad' => $bien['cantidad'],
                        'especificaciones' => $bien['especificaciones'],
                        'estado' => 1,
                        'created_by' => Auth::user()->id
                    ]);
            }
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
        
    }
    
    public function render()
    {
        $requerimientos = Requerimiento::where('estado',1)->where('estado_proceso',2)->when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })->paginate(10);
        return view('livewire.financiero-contable.pedidos.orden-compra.table',['requerimientos'=>$requerimientos]);
    }
}
