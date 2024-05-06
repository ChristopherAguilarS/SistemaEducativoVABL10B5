<?php
namespace App\Livewire\FinancieroContable\Compras\Compras;
use App\Models\FinancieroContable\Compra;
use App\Models\FinancieroContable\CatalogoFormaPago;
use App\Models\FinancieroContable\CompraPedido;
use App\Models\FinancieroContable\CompraPedidoTemp;
use App\Models\FinancieroContable\Pedido;
use App\Models\FinancieroContable\PedidoDetalle;
use App\Models\FinancieroContable\CatalogoProveedor;
use App\Models\FinancieroContable\GestorCompra;
use App\Models\FinancieroContable\CompraDetalleTemp;
use App\Http\Controllers\FinancieroContable\FuncionesCtrl;
use App\Models\FinancieroContable\Moneda;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use DB;
use App\Http\Controllers\Controller;
use App\Models\FinancieroContable\Almacen;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $items = [], $codEmp,$nomProv, $facturado = 0, $lugar_entrega,$monedas,$codProv,$pedidos = [],$cod, $almacen_tipo,$nomAlm, $nomAlmDes, $estado = 0,$state = ['almacen_id' => 0, 'tipo_id' => 1, 'estado' => 0, 'moneda_id' =>1], $ver = 0, $showModal = false, $editar = false, $idR, $idSel, $codProy, $nomProy, $codTrab, $nomTrab, $aprobar, $igv = [], $precio = ['monto', 'conIgv', 'sinIGV', 'pConIGV', 'pSinIGV'];
    public $proveedores, $mon = '',$gestores, $formas, $tpp, $local_id, $idCorr, $ordenes_ids, $pedidos_ids, $pedidos_pend, $pedido_id;
    #[On('savPedido')]
    public function savPedido($cabecera, $detalle){
        if($this->items){
            $this->items = $this->items + $detalle;
        }else{
            $this->items = $detalle;
        }
        if($this->pedidos){
            $this->pedidos = $this->pedidos + $cabecera;
        }else{
            $this->pedidos = $cabecera;
        }
        $this->pedidos = $this->pedidos + $cabecera;
        $this->dispatch('alert_info', ['mensaje' => 'Pedido añadido correctamente.']);
    }
    public function selPedido(){
        try{
            DB::beginTransaction();
                $sav = CompraPedidoTemp::updateorcreate(
                    ['pedido_id' => $this->pedido_id], 
                    [
                        'almacen_id' => $this->local_id, 
                        'almacen_tipo' => $this->almacen_tipo, 
                        'created_by' => auth()->user()->id, 
                        'created_at' => date('Y-m-d')
                    ]);
                if($sav){
                    $ddtt = PedidoDetalle::where('pedido_id', $this->pedido_id)->whereRaw('estado = 2 and (compra_id is null or compra_id = 0)')->get();
                    foreach ($ddtt as $item) {
                        $sav = CompraDetalleTemp::updateorcreate(
                            [
                                'pedido_detalle_id' => $item->id,
                                'created_by' => auth()->user()->id
                            ], [
                                'pedido_detalle_id' => $item->id, 
                                'tipo_seleccion' => 1, 
                                'almacen_id' => $this->local_id,
                                'almacen_tipo' => $this->almacen_tipo, 
                                'created_by' => auth()->user()->id, 
                                'created_at' => date('Y-m-d')
                            ]);
                    }
                }
                $this->dispatch('rTab');
            DB::commit();
            $this->dispatch('alert_info', ['mensaje' => 'Pedido agregado correctamente.']);
            $this->showModal = false;
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un error inesperado.']);
        }
    }
    #[On('savItem')]
    public function savItem($arr){
        $this->items[$arr['id']] = $arr;
        $this->dispatch('alert_info', ['mensaje' => 'Item actualizado correctamente.']);
    }
    #[On('savCant')]
    public function savCant($arr){
        $this->items[$arr['id']]['mod_cant'] = $arr['mod_cant'];
        $this->dispatch('alert_info', ['mensaje' => 'Cantidad actualizada correctamente.']);
    }
    public function editarItem($id){
        $this->dispatch('verRecurso',$this->items[$id], $this->ver);
    }
    #[On('rTab')]
    public function rTab(){
        $this->obtItems($this->idSel);
        $this->obtPedidos($this->idSel);
    }
    public function cancelar(){
        $del1 = PedidoDetalle::where('compra_id', $this->idSel)->update(['eliminar' => 0]);
        $del2 = CompraDetalleTemp::where('created_by', auth()->user()->id)->delete();
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
        $this->showModal = false;
    }
    #[On('brPedido')]
    public function brPedido(){
        if($this->editar){
            $this->pedidos[$this->idR]['eliminar'] = 1;
            $this->pedidos[$this->idR]['tpp'] = 1;

            foreach ($this->items as $val) {
                if ($val['pedido_id'] == $this->idR) {
                    $this->items[$val['id']]['eliminar'] = 1;
                    $this->items[$val['id']]['tpp'] = 1;
                }
            }
        }else{
            $del1 = CompraPedidoTemp::where('pedido_id', $this->idR)->delete();
            if($del1){
                $dd = PedidoDetalle::where('pedido_id', $this->idR)->where('estado', 2)->get();
                $ids = $dd->pluck('id');
                $ids = CompraDetalleTemp::whereIn('pedido_detalle_id', $ids)->delete();
            }
            $this->obtPedidos($this->idSel);
            $this->obtItems($this->idSel);
        }
        $this->dispatch('rTab');
        $this->dispatch('alert_info', ['mensaje' => 'Pedido retirado correctamente']);
    }
    #[On('delPedido')]
    public function delPedido($id){
        $this->idR = $id;
        $this->dispatch('confirmar', [
            'mensaje' => '¿Desea eliminar el Pedido: #'.str_pad($id, 6, "0", STR_PAD_LEFT).'?', 
            'detalle' => 'Se eliminara el nivel con codigo Nro.'.$id, 
            'funcion' => 'brPedido'
        ]);
    }
    public function updatedStateMonedaId($id){
        $obj = new Controller();
        $data = $obj->verTipoCambio($this->state['fecha']);
        $this->state['tipo_cambio'] = $data['valor'];
    }
    public function obtItems($id){
        $this->items = [];
        if($this->almacen_tipo == 1 || $this->almacen_tipo == 2){
            $l = 'log_insumos as l';
        }elseif($this->almacen_tipo == 3){
            $l = 'log_catalogo_equipos as l';
        }
        if($this->ver == 1){
            $items = CompraDetalleTemp::join('log_pedidos_detalles as pd', 'pd.id', 'log_compras_detalles_temp.pedido_detalle_id')
                ->join('log_pedidos as p','p.id','pd.pedido_id')
                ->join($l, 'l.id', 'pd.item_id')
                ->leftjoin('log_catalogo_unidad_medida as u', 'u.id', 'l.catalogoUnidadMedida_id')
                ->select(
                    'l.id as idi',
                    'p.correlativo',
                    'l.nombre as nom', 
                    'pd.cantidad_aprobada as cant',
                    'log_compras_detalles_temp.mod_cant',
                    'log_compras_detalles_temp.id', 
                    'p.id as compra_id',
                    'pd.id as idpd', 
                    'u.nombre as medida',
                    'log_compras_detalles_temp.porcentaje_igv',
                    'log_compras_detalles_temp.com_sin_igv',
                    'log_compras_detalles_temp.com_igv',
                    'log_compras_detalles_temp.com_con_igv',
                    'log_compras_detalles_temp.com_par_con_igv',
                    'log_compras_detalles_temp.com_par_sin_igv',
                    'log_compras_detalles_temp.tipo_seleccion', 
                    'pd.pedido_id',
                    DB::raw("'1' as tpp"),
                    DB::raw("'0' as eliminar")
                )
                ->where('log_compras_detalles_temp.created_by', auth()->user()->id)
                ->where('log_compras_detalles_temp.almacen_id', $this->state['almacen_id'])
                ->get();
            $this->ordenes_ids = $items->pluck('compra_id')->unique()->toArray();
            $this->pedidos_ids = $items->pluck('pedido_id')->unique()->toArray();
        }else{
            $items = PedidoDetalle::join($l, 'l.id', 'log_pedidos_detalles.item_id')
                    ->join('log_pedidos as p','p.id','log_pedidos_detalles.pedido_id')
                    ->leftjoin('log_catalogo_unidad_medida as u', 'u.id', 'l.catalogoUnidadMedida_id')
                    ->select(
                        'l.id as idi',
                        'p.correlativo',
                        'l.nombre as nom',
                        'cantidad_aprobada as cant',
                        DB::raw("'0' as mod_cant"),
                        'log_pedidos_detalles.id', 
                        'log_pedidos_detalles.compra_id', 
                        'log_pedidos_detalles.id as idpd',
                        'u.nombre as medida', 
                        'porcentaje_igv',
                        'com_sin_igv',
                        'com_igv',
                        'com_con_igv', 
                        'com_par_con_igv', 
                        'com_par_sin_igv', 
                        'tipo_seleccion', 
                        'log_pedidos_detalles.pedido_id',
                        DB::raw("'1' as tpp"),
                        DB::raw("'0' as eliminar")
                    )
                    ->where('log_pedidos_detalles.compra_id', $id)->get();
                $this->ordenes_ids = $items->pluck('compra_id')->unique()->toArray();
                $this->pedidos_ids = $items->pluck('pedido_id')->unique()->toArray();
        }
        $this->items = $items->pluck(null, 'id')->toarray();
    }
    public function obtPedidos($id){
        $this->pedidos = [];
        if($this->pedidos_ids){
            $pedidos = Pedido::leftjoin('rrhh_personas as p', 'p.id', 'log_pedidos.trabajador_id')
                    ->select(
                        'log_pedidos.id',
                        'log_pedidos.correlativo',
                        DB::Raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as solicitante"),
                        DB::raw("'1' as tpp"),
                        DB::raw("'0' as eliminar")
                    )
                    ->whereIn('log_pedidos.id', $this->pedidos_ids)
                    ->get();
            $this->pedidos = $pedidos->pluck(null, 'id')->toarray();
        }
            
    }
    #[On('nuevo')]
    public function ver($id = 0, $loc = 0, $ver = 1){
        $this->ver = $ver;
        $this->state['local_id'] = $loc;
        $this->editar = false;
        if($ver == 1){
            $this->titulo = "Nueva Orden de Compra";
            $nn = Almacen::join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'log_almacenes.categoria_id')
                ->select('cc.tipo', 'log_almacenes.nombre as almacen', 'log_almacenes.id')
                ->where('log_almacenes.id', $loc)
                ->first();
            $this->codEmp = $nn->empRuc.' - '.$nn->empNom;
            $this->idSel = 0;
            $this->idCorr = 0;
            $this->almacen_tipo= $nn->tipo;
            $this->local_id = $nn->id;
            $this->nomAlm = $nn->almacen;
            $this->codTrab = '';
            $this->proveedor_nom = '';
            $this->codProv = '';
            $this->nomProv = '';
            $this->estado = 0;
            $this->precio = ['com_sin_igv' => [], 'com_con_igv' => [], 'com_par_con_igv' => [], 'com_par_sin_igv' => []];
            $this->pedidos = [];
            $this->state = ['lugar_entrega' => $nn->empDir, 'proveedor_id' => 0, 'tipo_cambio' => '','empresa_id' => $nn->empId, 'trabajador_id' =>0, 'moneda_id' =>1, 'fecha' =>date('Y-m-d'), 'fecha_entrega' =>date('Y-m-d'), 'forma_pago_id' =>1,'nombre' => '', 'estado' => 1, 'tipo_id' => 1, 'almacen_id' =>$loc, 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')];
        }elseif($ver == 2){
            $this->titulo = "Visualizacion de Orden de Compra";
        }elseif($ver == 3){
            $this->titulo = "Aprobación de Orden de Compra";
        }elseif($ver == 4){
            $this->editar = $id;
            $this->titulo = "Edición de Orden de Compra";
        }
        $this->formas = CatalogoFormaPago::get()->toArray();
        $this->monedas = Moneda::get()->toArray();
        if($id){
            $data= Compra::leftjoin('log_almacenes as la', 'la.id', 'log_compras.almacen_id')
                ->leftjoin('log_catalogo_categorias_almacenes as cc', 'cc.id', 'la.categoria_id')
                ->leftjoin('log_catalogo_proveedores as pp', 'pp.id', 'log_compras.proveedor_id')
                ->leftjoin('rrhh_personas as p', 'log_compras.trabajador_id', 'p.id')
                ->leftjoin('log_catalogo_monedas as m', 'log_compras.moneda_id', 'm.id')
                ->select(
                    'log_compras.correlativo',
                    'log_compras.id as idcompra',
                    'ingreso_id',
                    'log_compras.estado',
                    'log_compras.proveedor_id',
                    'pp.nombre as nomp',
                    'pp.id as idp',
                    'log_compras.observaciones',
                    'lugar_entrega',
                    'log_compras.fecha',
                    'moneda_id',
                    'simbolo as mon',
                    'log_compras.fecha_entrega',
                    'log_compras.forma_pago_id',
                    'log_compras.fecha_entrega',
                    'log_compras.id',
                    'la.id as almacen_id',
                    'log_compras.trabajador_id as trabajador_id',
                    'numeroDocumento',
                    'usuario_aprueba_fecha',
                    DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as trab"), 
                    'la.nombre as almacen', 
                    'cc.tipo')
                ->where('log_compras.id', $id)->first();
                
            if(isset($data->ingreso_id) && $data->ingreso_id && $this->ver == 4){
                $this->dispatch('info', ['mensaje' => 'Ingreso Registrado ['.$data->codigoProyecto.'-'.$data->ingreso_id.']', 'detalle' => 'No se puede editar una OC/OS que ya tiene un ingreso registrado.', 'icon' => 'warning']);
                return;
            }elseif($data->estado == 2 && $ver == 4){
                $this->dispatch('info', ['mensaje' => 'Aprobado el '.date('d/m/Y', strtotime($data->usuario_aprueba_fecha)), 'detalle' => 'Se debe retirar la aprobación para poder editar.', 'icon' => 'warning']);
                return;
            }else{
                $this->proveedor_nom = $data->nomp;	
                $this->codEmp = $data->empRuc.' - '.$data->empNom;
                $this->codProy = $data->codigoProyecto;
                $this->cod = str_pad($data->correlativo, 10, "0", STR_PAD_LEFT);
                $this->nomProy = $data->local;
                $this->nomAlm = $data->almacen;
                $this->codTrab = $data->numeroDocumento;
                $this->nomTrab = $data->trab;
                $this->almacen_tipo= $data->tipo;
                $this->mon= $data->mon;
                $this->pedidos = [];
                $this->idSel = $id;
                $this->idCorr = $data->correlativo;
                $this->codEmp = $data->empRuc.' - '.$data->empNom;
                $this->facturado = $data->facturacion;
                $this->estado = $data->estado;
                $this->state = ['almacen_id' => $data->almacen_id, 'proveedor_id' => $data->proveedor_id,'empresa_id' => $data->empId, 'fecha' => $data->fecha, 'fecha_entrega' => $data->fecha_entrega, 'forma_pago_id' =>$data->forma_pago_id, 'moneda_id' => $data->moneda_id, 'lugar_entrega' => $data->lugar_entrega, 'observaciones' => $data->observaciones, 'tipo_id' => $data->tipo_id, 'trabajador_id' => $data->trabajador_id, 'updated_by' => auth()->user()->id, 'updated_at' => date('Y-m-d H:i')];
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
            }
        }
        if($this->state['almacen_id']){
            $this->obtItems($this->idSel);
            $this->obtPedidos($this->idSel);
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    public function guardar() {
        $this->validate(['state.fecha' => 'required', 'state.fecha_entrega' => 'required', 'state.proveedor_id' => 'required|not_in:0', 'state.almacen_id' => 'required|not_in:0', 'state.trabajador_id' => 'required|not_in:0']);
        
        $err = 0;
        if($this->state['moneda_id'] == 2){
            $this->validate(['state.tipo_cambio' => 'required|not_in:0']);
        }
        foreach ($this->items as $elemento) {
            if ($elemento['com_sin_igv'] == 0 && $elemento['eliminar'] != 1) {
                $err++;
            }
        }
        if(!count($this->items)){
            $this->dispatch('alert_danger', ['mensaje' => 'Debes agregar almenos 01 recurso.']);
        }elseif($err){
            $this->dispatch('alert_danger', ['mensaje' => 'No se admiten items sin precio.']);
        }else{
            if($this->editar){
                $dels = [];
                $dels2 = [];
                $tt = 0;
                foreach ($this->items as $item) {
                    if($item['eliminar']){
                        $dels[] = $item['id'];
                    }else{
                        $tt += $item['com_par_con_igv'];
                        $varr = [
                            'compra_id' => $this->editar,
                            'com_sin_igv' => $item['com_sin_igv'],
                            'tipo_seleccion' => $item['tipo_seleccion'],
                            'com_igv' => $item['com_igv'],
                            'com_con_igv' => $item['com_con_igv'],
                            'com_par_sin_igv' => $item['com_par_sin_igv'],
                            'com_par_con_igv' => $item['com_par_con_igv'],
                            'porcentaje_igv'=>$item['porcentaje_igv'],
                            'updated_by' => auth()->user()->id,
                            'updated_at' => date('Y-m-d H:i')
                        ];
                        if($item['mod_cant']){
                            $varr['cantidad_aprobada'] = $item['mod_cant'];
                            $productoOriginal = PedidoDetalle::find($item['id']);
                            $nuevoProducto = $productoOriginal->replicate();
                                $nuevoProducto->com_sin_igv = null;
                                $nuevoProducto->com_igv = null;
                                $nuevoProducto->com_con_igv = null;
                                $nuevoProducto->com_par_sin_igv = null;
                                $nuevoProducto->com_par_con_igv = null;
                                $nuevoProducto->created_at = date('Y-m-d H:i:s');
                                $nuevoProducto->created_by = auth()->user()->id;
                                $nuevoProducto->com_par_con_igv = null;
                                $nuevoProducto->cantidad_aprobada = $nuevoProducto['cantidad_aprobada']-$item['mod_cant'];
                            $nuevoProducto->save();
                        }
                        $ss = PedidoDetalle::where('id', $item['id'])->update($varr);
                    }
                }
                $data = Compra::find($this->editar);
                    $data->proveedor_id = $this->state['proveedor_id'];
                    $data->total = $tt;
                    $data->trabajador_id = $this->state['trabajador_id'];
                    $data->fecha = $this->state['fecha'];
                    $data->fecha_entrega = $this->state['fecha_entrega'];
                    $data->forma_pago_id = $this->state['forma_pago_id'];
                    $data->moneda_id = $this->state['moneda_id'];
                    $data->lugar_entrega = $this->state['lugar_entrega'];
                    $data->observaciones = $this->state['observaciones'];
                    $data->updated_by = auth()->user()->id;
                    $data->updated_at = date('Y-m-d H:i:s');
                $data->save();
                foreach($this->pedidos as $pedido){
                    if($pedido['eliminar']){
                        $dels2[] = $pedido['id'];
                    }else{
                        $sav2 = CompraPedido::create(
                            [
                                'pedido_id' => $pedido['id'],
                                'compra_id' => $this->editar,
                                'created_by' => auth()->user()->id,
                                'created_at' => date('Y-m-d H:i')
                            ]
                        );
                    }
                }
                if($dels){
                    $del1 = PedidoDetalle::whereIn('id', $dels)->update([
                        'compra_id'=> 0,
                    ]);
                }
                if($dels2){
                    $del2 = Pedido::whereIn('id', $dels2)->update([
                        'compra_id'=> 0,
                    ]);
                }
                $this->obtItems($this->idSel);
                $this->dispatch('renderizarTbl');
                $this->dispatch('alert_info', ['mensaje' => 'OC/OS editada correctamente.']);
            }else{
                $obj = new FuncionesCtrl();
                $corr = $obj->obtCorrelativoOrden($this->local_id, $this->almacen_tipo);
                $this->state['correlativo'] = $corr;
                $this->state['tipo_movimiento'] = 0;
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d H:i');
                $this->state['tipo'] = $this->almacen_tipo;
                $this->state['ingreso_tipo'] = 2;
                $dt1 = CompraPedidoTemp::where('created_by', auth()->user()->id)
                    ->where('almacen_id', $this->state['almacen_id'])
                    ->where('almacen_tipo', $this->almacen_tipo)
                    ->get();
                $dt2 = CompraDetalleTemp::join('log_pedidos_detalles as pd', 'pd.id', 'log_compras_detalles_temp.pedido_detalle_id')
                    ->select(
                        'log_compras_detalles_temp.pedido_detalle_id', 
                        'log_compras_detalles_temp.mod_cant', 
                        'log_compras_detalles_temp.tipo_seleccion', 
                        'log_compras_detalles_temp.id','pd.cantidad_aprobada',
                        'log_compras_detalles_temp.com_igv',
                        'log_compras_detalles_temp.porcentaje_igv',
                        'log_compras_detalles_temp.valor_igv',
                        'log_compras_detalles_temp.com_sin_igv',
                        'log_compras_detalles_temp.com_con_igv',
                        'log_compras_detalles_temp.com_par_con_igv',
                        'log_compras_detalles_temp.com_par_sin_igv'
                    )
                    ->where('log_compras_detalles_temp.created_by', auth()->user()->id)
                    ->where('log_compras_detalles_temp.almacen_id', $this->state['almacen_id'])
                    ->where('log_compras_detalles_temp.almacen_tipo', $this->almacen_tipo)
                    ->get();
                try{
                    DB::beginTransaction();
                        if($dt1 || $dt2){
                            $this->state['total'] = $dt2->sum('com_par_con_igv');
                            if(!$this->state['tipo_cambio']){$this->state['tipo_cambio'] = 0;};
                            $sav = Compra::create($this->state);
                            if($sav){
                                if($dt1){
                                    foreach($dt1 as $dd){
                                        $sav2 = CompraPedido::create(
                                            [
                                                'pedido_id' => $dd->pedido_id,
                                                'compra_id' => $sav->id,
                                                'created_by' => auth()->user()->id,
                                                'created_at' => date('Y-m-d H:i')
                                            ]
                                        );
                                    }
                                    $dt1_ids = $dt1->pluck('pedido_id');
                                    $dt2_ids = $dt2->pluck('pedido_detalle_id');
                                    $sav3 = Pedido::whereIn('id', $dt1_ids)->update(['compra_id' =>$sav->id]);
                                    $sav4 = PedidoDetalle::whereIn('pedido_id', $dt1_ids)->whereRaw("(compra_id is null or compra_id =0)")->update(['compra_id' =>$sav->id]);
                                    $del1 = CompraPedidoTemp::whereIn('pedido_id', $dt1_ids)->delete();
                                    $del2 = CompraDetalleTemp::whereIn('pedido_detalle_id', $dt2_ids)->delete();
                                }
                                if($dt2){
                                    foreach ($dt2 as $item) {
                                        $varr = [
                                            'compra_id' =>$sav->id,
                                            'tipo_seleccion' =>$item->tipo_seleccion,
                                            'com_igv' =>$item->com_igv,
                                            'porcentaje_igv' =>$item->porcentaje_igv,
                                            'valor_igv' =>number_format($item->valor_igv, 4, '.', ''),
                                            'com_sin_igv' => number_format($item->com_sin_igv, 4, '.', ''),
                                            'com_con_igv' => number_format($item->com_con_igv, 4, '.', ''),
                                            'com_par_con_igv' => number_format($item->com_par_con_igv, 4, '.', ''),
                                            'com_par_sin_igv' => number_format($item->com_par_sin_igv, 4, '.', ''),
                                        ];
                                        if($item->mod_cant){
                                            $varr['cantidad_aprobada'] = $item->mod_cant;
                                            $productoOriginal = PedidoDetalle::find($item->pedido_detalle_id);
                                            $nuevoProducto = $productoOriginal->replicate();
                                                $nuevoProducto->cantidad_aprobada = $nuevoProducto->cantidad_aprobada-$item->mod_cant;
                                            $nuevoProducto->save();
                                        }
                                        $sav3 = PedidoDetalle::where('id', $item->pedido_detalle_id)->update($varr);
                                    }
                                }
                            }
                        }
                    DB::commit();
                    $this->dispatch('alert_info', ['mensaje' => 'OC/OS guardada correctamente.']);
                    $this->dispatch('renderizarTbl');
                    $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
                               
                }catch(\Exception $e){
                    DB::rollback();
                    dd($e);
                    $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un error inesperado.']);
                }
            }
        }
    }
    #[On('brCompra')]
    public function brCompra(){
        $tt = Compra::where('id', $this->idR)->whereRaw('(ingreso_id is null or ingreso_id = 0)')->get();
        if($tt){
            $ids = $tt->pluck('id');
            $del = Compra::whereIn('id', $ids)->delete();
            $del2 = CompraPedido::whereIn('compra_id', $ids)->delete();
            $del3 = PedidoDetalle::whereIn('compra_id', $ids)->update(['compra_id'=> 0]);
            $del4 = Pedido::whereIn('compra_id', $ids)->update(['compra_id'=> 0]);
        }
        $this->dispatch('renderizarTbl');
        $this->dispatch('alert_info', ['mensaje' => 'Orden de Compra eliminado correctamente']);
    }
    #[On('delCompra')]
    public function delCompra($id){
        $data= Compra::find($id);
        if($data->estado == 2 && $this->ver == 4){
            $this->dispatchBrowserEvent('info', ['texto' => 'Aprobado el '.date('d/m/Y', strtotime($data->usuario_aprueba_fecha)), 'footer' => 'Se debe retirar la aprobación para poder eliminar la O/C -  O/S.', 'icon' => 'warning']);
            return;
        }else{
            $this->idR = $id;
            $this->confirm('¿Desea eliminar la OC/OS: #'.str_pad($id, 6, "0", STR_PAD_LEFT).'?', [
                'onConfirmed' => 'brCompra',
                'confirmButtonText' => 'Eliminar',
                'cancelButtonText' => 'Cancelar',
            ]);
        }
    }
    public function mount(){
        $this->formas = CatalogoFormaPago::where('estado', 1)->get();
        $this->monedas = Moneda::where('estado', 1)->get();
    }
    public function aprobar2(){
        $this->dispatch('confirmar', ['mensaje' => '¿Desea Aprobar la O/C: #'.str_pad($this->idCorr, 6, "0", STR_PAD_LEFT).'?', 'detalle' => '', 'funcion' => 'apCompra']);
    }
    public function desaprobar(){
        $veri = Compra::where('id', $this->idSel)->first();
        if($veri->facturacion){
            $this->dispatch('alert_danger', ['mensaje' => 'Error: La OC/OS ya tiene una venta asociada.']);
        }else{
            $this->confirm('¿Desea Desaprobar la O/C: #'.str_pad($this->idCorr, 6, "0", STR_PAD_LEFT).'?', [
                'onConfirmed' => 'desCompra',
                'confirmButtonText' => 'Desaprobar',
                'cancelButtonText' => 'Cancelar',
            ]);
        }
    }
    #[On('apCompra')]
    public function apCompra(){
        $sav = Compra::where('id', $this->idSel)
            ->update([
                'estado' => 2,
                'usuario_aprueba' => auth()->user()->id,
                'usuario_aprueba_fecha' => date('Y-m-d H:i:s')
            ]);
        if($sav){
            $this->dispatch('alert_info', ['mensaje' => 'Compra aprobada correctamente.']);
            $this->dispatch('renderizarTbl');
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
             
        }
    }
    #[On('desCompra')]
    public function desCompra(){
        $sav = Compra::where('id', $this->idSel)
            ->update([
                'estado' => 1,
                'usuario_aprueba' => 0,
                'usuario_aprueba_fecha' => date('Y-m-d H:i:s')
            ]);
        if($sav){
            $this->dispatch('alert_info', ['mensaje' => 'Compra desaprobada correctamente.']);
            $this->dispatch('renderizarTbl');
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
             
        }
    }
    public function render() {
        $this->gestores = GestorCompra::join('rrhh_personas as p', 'p.id', 'log_gestores_compras.persona_id')
            ->select('apellidoPaterno', 'apellidoMaterno', 'nombres', 'numeroDocumento', 'log_gestores_compras.estado', 'p.id')
            ->get();
            $this->proveedores = CatalogoProveedor::get();
            $this->pedidos_pend = Pedido::join('log_almacenes as a', 'a.id', 'log_pedidos.almacen_id')
                ->join('log_pedidos_detalles as pd', 'pd.pedido_id', 'log_pedidos.id')
                ->leftjoin('log_compras_pedidos_temp as cp', 'cp.pedido_id', 'log_pedidos.id')
                ->join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'a.categoria_id')
                ->join('rrhh_personas as p', 'p.id', 'log_pedidos.trabajador_id')
                ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as solicitante"), 'log_pedidos.id', 'fecha', 'log_pedidos.correlativo', 'codigo_manual',)
                ->where('cp.id', null)
                ->where('log_pedidos.almacen_id', $this->local_id)
                ->where('tipo_id', 1)
                ->whereRaw('pd.estado = 2 and (pd.compra_id is null or pd.compra_id = 0)')
                ->distinct()
                ->get();
        return view('livewire.financiero-contable.compras.compras.ver-detalles');
    }
}