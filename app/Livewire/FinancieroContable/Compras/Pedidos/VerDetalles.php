<?php
namespace App\Livewire\FinancieroContable\Compras\Pedidos;


use App\Models\FinancieroContable\PedidoDetalleTemp;
use App\Models\FinancieroContable\Pedido;
use App\Models\FinancieroContable\PedidoDetalle;
use App\Models\FinancieroContable\Almacen;
use App\Http\Controllers\Rrhh\FuncionesCtrl;
use App\Models\FinancieroContable\Moneda;
use App\Http\Controllers\FinancieroContable\FuncionesCtrl as logis;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use DB;
use App\Models\FinancieroContable\Insumo;
use App\Models\FinancieroContable\Tarea;
use App\Models\RecursosHumanos\VinculoLaboral;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $monedas ,$items = [], $loc_monedas, $userCreacion, $userFecha, $cod, $todo = 0, $cant = [],$almacen_tipo,$nomAlm, $nomAlmDes, $state = ['almacen_id' => 0, 'tipo_id' => 1, 'almacen_destino' =>0], $ver = 0, $editar = false, $idR, $idSel, $codProy, $nomProy, $codTrab, $nomTrab, $aprobar, $ap = [], $tpp, $almacen_id = 0;
    public $revisadoPor, $revisadoEl, $partidas, $prod = [],  $trabajadores;
    #[On('savItem')]
    public function savItem($arr){
        $this->items[$arr['id']] = $arr;
        $this->dispatch('alert_info', ['mensaje' => 'Item actualizado correctamente.']);
    }
    public function editarItem($id){
        if($this->state['tipo_id'] ==1){
            $alm = $this->state['almacen_id'];
        }else{
            $alm = $this->state['almacen_destino'];
        }
        $this->dispatch('editarItem', $this->items[$id], $alm, $this->ver);
    }
    #[On('selAlm')]
    public function selAlm($id, $local, $almacen){
        $this->nomAlmDes = '<b>Proyecto: </b>'.$local.' - <b>Almacen:</b> '.$almacen;
        $this->dispatch('cerrarAlm');
        $this->state['almacen_destino'] = $id;
    }
    #[On('rTabItems')]
    public function rTab(){
        $this->vItems();
    }
    #[On('nuevo')]
    public function ver($id = 0, $almacen, $tp = 1){
        if(!$almacen){
            $this->dispatch('alert_danger', ['mensaje' => 'Debes seleccionar un almacen.']);
        }else{
            $this->ver = $tp;
            $this->todo =0;
            $this->idSel = $id;
            $this->almacen_id = $almacen;
            $this->ap = [];
            $nn = Almacen::join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'log_almacenes.categoria_id')
                ->select('cc.tipo', 'log_almacenes.nombre as almacen')
                ->find($almacen);
                $this->almacen_tipo= $nn->tipo; 
                $this->loc_monedas = [1, 2];
            if($tp == 1){
                $this->titulo = "Nuevo Pedido";
                $this->userCreacion = '';
                $this->userFecha = '';
                $this->nomAlm = $nn->almacen;
                $this->codTrab = '';
                $this->nomTrab = '';
                $this->nomAlmDes = 'Click para seleccionar almacen';
                $this->state = ['trabajador_id' =>0, 'codigo_manual' => '', 'almacen_destino' => 0,'observaciones' =>'', 'nombre' => '', 'estado' => 1, 'tipo_id' => 1, 'almacen_id' =>$almacen, 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')];
            }elseif($tp == 2){
                $this->titulo = "Visualizacion de Pedido";
            }elseif($tp == 3){
                $this->titulo = "Revisión de Pedido";
            }elseif($tp == 4){
                $this->titulo = "Edición de Pedido";
                $this->state['updated_by'] = auth()->user()->id;
                $this->state['updated_at'] = date('Y-m-d H:i');
            }
            if($id){
                $data= Pedido::join('log_almacenes as la', 'la.id', 'log_pedidos.almacen_id')
                    ->join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'la.categoria_id')
                    ->leftjoin('rrhh_personas as p', 'log_pedidos.trabajador_id', 'p.id')
                    ->leftjoin('rrhh_personas as p2', 'log_pedidos.created_by', 'p2.id')
                    ->leftjoin('rrhh_personas as p3', 'log_pedidos.updated_by', 'p3.id')
                    ->select('log_pedidos.id', 'moneda_id', 'log_pedidos.created_at', 'log_pedidos.updated_at', DB::raw("CONCAT(p2.apellidoPaterno, ' ', p2.apellidoMaterno, ', ', p2.nombres) as noms"), DB::raw("CONCAT(p3.apellidoPaterno, ' ', p3.apellidoMaterno, ', ', p3.nombres) as revisado"), 'codigo_manual','almacen_destino','log_pedidos.observaciones', 'la.id as almacen_id', 'p.id as trabajador_id','p.numeroDocumento', DB::raw("CONCAT(p.apellidoPaterno, ' ', p.apellidoMaterno, ', ', p.nombres) as trab"), 'la.nombre as almacen', 'cc.tipo', 'tipo_id')
                    ->where('log_pedidos.id', $id)->first();
                    
                $this->revisadoPor = $data->revisado;
                $this->revisadoEl = date('d/m/Y - h:i a', strtotime($data->updated_at));
                $this->userCreacion = $data->noms;
                $this->userFecha = date('Y-m-d', strtotime($data->created_at));
                $this->codProy = $data->codigoProyecto;
                $this->cod = str_pad($data->id, 10, "0", STR_PAD_LEFT);
                $this->nomProy = $data->local;
                $this->nomAlm = $data->almacen;
                $this->codTrab = $data->numeroDocumento;
                $this->nomTrab = $data->trab;
                $this->almacen_tipo= $data->tipo;
                $this->state['almacen_id'] = $data->almacen_id;
                $this->state['almacen_destino'] = $data->almacen_destino;
                $this->state['codigo_manual'] = $data->codigo_manual;
                $this->state['tipo_id'] = $data->tipo_id;
                $this->state['moneda_id'] = $data->moneda_id;
                $this->state['observaciones'] = $data->observaciones;
                $this->state['trabajador_id'] = $data->trabajador_id;
            }
            $this->monedas = Moneda::whereIn('id', $this->loc_monedas)->get()->toarray();
            $this->vItems();
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
        }
    }
    public function toggleAll(){
        foreach ($this->ap as $key => $value) {
            $this->ap[$key] = $this->todo;
        }
    }
    public function aprobar1(){
        $sav1 = Pedido::find($this->idSel);
        $sav1->update([
            'updated_at' => now(),
            'updated_by' => auth()->user()->id,
        ]);
        try{
            if(count($this->ap)>0){
                DB::beginTransaction();
                        //$this->ap = array_diff($this->ap, array(false));
                    foreach($this->ap as $indice => $valor){
                        $sav = PedidoDetalle::where('id', $indice)->update([
                            'estado' =>$valor,
                            'cantidad_aprobada' =>$this->cant['apro'][$indice], 
                            'aprobacionUser_id' =>auth()->user()->id, 
                            'aprobacionFecha' => date('Y-m-d H:i')
                        ]);
                    }
                DB::commit();
                $this->dispatch('alert_info', ['mensaje' => 'Revisión guardada correctamente.']);
                $this->dispatch('renderizarTbl');
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            }else{
                $this->dispatch('alert_danger', ['mensaje' => 'Debes seleccionar almenos 01 item.']);
            }
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->dispatch('alert_idanger', ['mensaje' => 'Ocurrio un error inesperado.']);
        }
    }
    public function guardarPedido() {
        $this->validate(['state.trabajador_id' => 'required|not_in:0', 'state.moneda_id' => 'required|not_in:0']);
        try{
            DB::beginTransaction();
                if($this->idSel){
                    $data = Pedido::find($this->idSel);
                        $data->trabajador_id = $this->state['trabajador_id'];
                        $data->tipo_id = $this->state['tipo_id'];
                        $data->observaciones = $this->state['observaciones'];
                        $data->codigo_manual = $this->state['codigo_manual'];
                        $data->updated_by = auth()->user()->id;
                        $data->updated_at = date('Y-m-d H:i:s');
                    $data->save();
                    $del = PedidoDetalle::where('pedido_id', $this->idSel)->delete();
                    $dt = [];
                    $dels = [];
                    foreach ($this->items as $item) {
                        if($item['eliminar']){
                            $dels[] = $item['id'];
                        }else{
                            if(!isset($item['precio'])){
                                $item['precio'] = 0;
                            }
                            $ss = PedidoDetalle::updateorcreate([
                                'pedido_id' => $this->idSel,
                                'item_id' => $item['item_id'],
                                'item_tipo' => $this->almacen_tipo
                            ], [
                                'pedido_id' => $this->idSel,
                                'item_id' => $item['item_id'],
                                'item_tipo' => $this->almacen_tipo,
                                'cantidad' => $item['cantidad'],
                                'almacen_id' => $this->state['almacen_id'],
                                'tarea_id' => $item['tarea_id'],
                                'precio' => $item['precio'],
                                'estado'=>1,
                                'created_by' => auth()->user()->id,
                                'created_at' => date('Y-m-d H:i')
                            ]);
                        }
                    }
                    if($dels){
                        $del1 = PedidoDetalle::whereIn('id', $dels)->delete();
                    }
                    
                    $del2 = PedidoDetalleTemp::where('log_pedidos_detalles_temp.created_by', auth()->user()->id)
                        ->where('almacen_tipo', $this->almacen_tipo)
                        ->delete();
                }else{
                    $cant = PedidoDetalleTemp::where('log_pedidos_detalles_temp.created_by', auth()->user()->id)
                        ->where('almacen_tipo', $this->almacen_tipo)
                        ->get()
                        ->count();
                    if($cant){
                        $obj = new logis();
                        $corr = $obj->obtCorrelativoPedido($this->almacen_id, $this->almacen_tipo);
                        $this->state['correlativo'] = $corr;
                        $this->state['created_by'] = auth()->user()->id;
                        $this->state['created_at'] = date('Y-m-d H:i:s');
                        $this->state['fecha'] = date('Y-m-d H:i:s');
                        if($this->state['tipo_id'] == 1){
                            $this->state['almacen_destino'] = 0;
                        }
                        $sav = Pedido::create($this->state);
                        if($sav){
                            $sav2 = DB::statement("INSERT INTO log_pedidos_detalles(pedido_id, item_id, item_tipo, tarea_id, precio, almacen_id, cantidad, estado, created_by, created_at) 
                                        SELECT ".$sav->id.", item_id, ".$this->almacen_tipo.", tarea_id, precio, almacen_id, cantidad, 1, ".auth()->user()->id.", '".date('Y-m-d H:i')."'
                                        FROM log_pedidos_detalles_temp WHERE created_by = ".auth()->user()->id." and almacen_tipo = ".$this->almacen_tipo."
                                        ");
                        }
                        $del = PedidoDetalleTemp::where('log_pedidos_detalles_temp.created_by', auth()->user()->id)
                            ->where('almacen_tipo', $this->almacen_tipo)
                            ->delete();
                    }
                }
                $this->dispatch('alert_info', ['mensaje' => 'Pedido guardado correctamente.']);
                $this->dispatch('renderizarTbl');
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un Error']);
        }
    }
    #[On('eliminarPedido')]
    public function eliminar($id, $corr){
        $this->idR = $id;
        $this->selCorr = $corr;
        $this->confirm('¿Desea eliminar el Pedido: #'.str_pad($corr, 6, "0", STR_PAD_LEFT).'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    #[On('borrar')]
    public function borrar(){
        $dd = PedidoDetalle::whereRaw('pedido_id = '.$this->idR.' and  compra_id !=0')->first();
        if($dd){
            $this->dispatchBrowserEvent('info', ['texto' => 'No se puede eliminar', 'footer' => 'el pedido #'.str_pad($this->selCorr, 6, "0", STR_PAD_LEFT).', ya tiene una OC/OS asociada, elimine la orden para poder eliminar.', 'icon' => 'warning']);
        }else{
            $del1 = Pedido::where('id', $this->idR)->delete();
            $del1 = PedidoDetalle::where('pedido_id', $this->idR)->delete();
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            $this->dispatch('renderizarTbl');
            $this->dispatch('alert_info', ['mensaje' => 'Pedido eliminado correctamente.']);
        }
    }
    public function cancelar(){
        $del1 = PedidoDetalle::where('pedido_id', $this->idSel)->update(['eliminar' => 0]);
        $del2 = PedidoDetalleTemp::where('created_by', auth()->user()->id)->delete();
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    #[On('eliminarItem')]
    public function eliminarItem($id, $tpp){
        $this->idR = $id;
        $this->tpp = $tpp;
        $this->dispatch('confirmar', ['mensaje' => '¿Desea retirar el Item: #'.$id.'?', 'detalle' => 'Se eliminara el nivel con codigo Nro.'.$id, 'funcion' => 'borrarItem']);
    }
    #[On('borrarItem')]
    public function borrarItem(){
        if($this->ver == 4){
            if($this->tpp){
                $this->items[$this->idR]['eliminar'] = 1;
            }else{
                $del1 = PedidoDetalleTemp::where('id', $this->idR)->delete();
                $this->vItems();
            }
        }elseif($this->ver == 1){
            $del1 = PedidoDetalleTemp::where('id', $this->idR)->delete();
            $this->vItems();
        }
        $this->dispatch('alert_info', ['mensaje' => 'Item retirado correctamente']);
    }
    public function mount(){
        $obj = new FuncionesCtrl();
        $this->solicitantes=$obj->personaActiva();
    }
    public function updatedStateTipoId(){
        $this->vItems();
    }
    public function vItems(){
        if($this->idSel){
            if($this->almacen_tipo == 1 || $this->almacen_tipo == 2){
                $prods = PedidoDetalle::leftjoin('log_compras as c','c.id', 'log_pedidos_detalles.compra_id')
                    ->join('log_insumos as l', 'l.id', 'log_pedidos_detalles.item_id')
                    ->leftjoin('log_catalogo_unidad_medida as um', 'um.id', 'l.catalogoUnidadMedida_id')
                    ->select('log_pedidos_detalles.estado','c.correlativo', 'um.nombre as medida', 'item_id', 'com_sin_igv', 'compra_id', 'tarea_id', 'l.nombre as nom', 'aprobacionUser_id', 'log_pedidos_detalles.id', 'cantidad', 'cantidad_aprobada', DB::raw("'1' as tpp"), 'eliminar', DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles.item_id  and st.almacen_id=log_pedidos_detalles.almacen_id) as en_almacen"))
                    ->where('pedido_id', $this->idSel)->get();
                if($this->ver == 4){
                    $temps= PedidoDetalleTemp::join('log_insumos as l', 'l.id', 'log_pedidos_detalles_temp.item_id')
                        ->leftjoin('log_catalogo_unidad_medida as um', 'um.id', 'l.catalogoUnidadMedida_id')
                        ->select(DB::raw("'1' as estado"), 'um.nombre as medida', 'item_id', 'precio as com_sin_igv', DB::raw("'0' as compra_id"), 'tarea_id', 'l.nombre as nom', DB::raw("'0' as aprobacionUser_id"), 'log_pedidos_detalles_temp.id', 'cantidad', DB::raw("'0' as cantidad_aprobada"), DB::raw("'0' as tpp"), DB::raw("'0' as eliminar"), DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles_temp.item_id  and st.almacen_id=log_pedidos_detalles_temp.almacen_id) as en_almacen"))
                        ->where('log_pedidos_detalles_temp.created_by', auth()->user()->id)->get();
                        $items = $prods->merge($temps);
                }else{
                    $items = $prods;
                }
            }elseif($this->almacen_tipo == 3){
                //EDICION/REVISAR/VER DE EQUIPO
                if($this->state['tipo_id'] == 2){
                    $prods = PedidoDetalle::leftjoin('log_compras as c','c.id', 'log_pedidos_detalles.compra_id')
                        ->join('log_equipos as e', 'e.id', 'log_pedidos_detalles.item_id')
                        ->join('log_catalogo_equipos as lc', 'lc.id', 'e.catalogoEquipos_id')
                        ->select('log_pedidos_detalles.estado', 'c.correlativo', DB::raw("'Unidad' as medida"),'log_pedidos_detalles.compra_id', 'tarea_id', 'log_pedidos_detalles.com_con_igv as precio','item_id', 'com_con_igv', 'lc.nombre as nom', DB::raw("'1' as tpp"), DB::raw("'0' as eliminar"), 'aprobacionUser_id','log_pedidos_detalles.id', 'cantidad', 'cantidad_aprobada', DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles.item_id  and st.almacen_id=log_pedidos_detalles.almacen_id) as en_almacen"))
                        ->where('pedido_id', $this->idSel)->get();
                }else{
                    $prods = PedidoDetalle::leftjoin('log_compras as c','c.id', 'log_pedidos_detalles.compra_id')
                        ->join('log_catalogo_equipos as lc', 'lc.id', 'log_pedidos_detalles.item_id')
                        ->select('log_pedidos_detalles.estado', 'c.correlativo', DB::raw("'Unidad' as medida"),'compra_id', 'tarea_id', 'log_pedidos_detalles.com_con_igv as precio','item_id', 'com_con_igv', 'lc.nombre as nom', DB::raw("'1' as tpp"), DB::raw("'0' as eliminar"), 'aprobacionUser_id','log_pedidos_detalles.id', 'cantidad', 'cantidad_aprobada', DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles.item_id  and st.almacen_id=log_pedidos_detalles.almacen_id) as en_almacen"))
                        ->where('pedido_id', $this->idSel)->get();
                }
                if($this->ver == 4){
                    $temps= PedidoDetalleTemp::join('log_catalogo_equipos as lc', 'lc.id', 'log_pedidos_detalles_temp.item_id')
                        ->select('lc.nombre as nom',  DB::raw("'0' as cantidad_aprobada"), 'tarea_id', 'item_id', 'log_pedidos_detalles_temp.precio', DB::raw("'Unidad' as medida"), DB::raw("'0' as tpp"), DB::raw("'0' as eliminar"), 'log_pedidos_detalles_temp.id', DB::raw('0 as compra_id'), DB::raw('1 as estado'), 'cantidad', DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles_temp.item_id  and st.almacen_id=log_pedidos_detalles_temp.almacen_id) as en_almacen"))
                        ->where('log_pedidos_detalles_temp.created_by', auth()->user()->id)
                        ->where('log_pedidos_detalles_temp.almacen_tipo', $this->almacen_tipo)
                        ->get();
                    $items = $prods->merge($temps);
                }else{
                    $items = $prods;
                }
            }
            if($items){
                $this->items = $items->pluck(null,'id')->toarray();
            }
            foreach($this->items as $item){
                $this->ap[$item['id']] = $item['estado'];
                $this->cant['sol'][$item['id']] = $item['cantidad'];

                if(!$item['cantidad_aprobada'] && $item['estado'] == 1){
                    $this->cant['apro'][$item['id']] = $item['cantidad'];
                }else{
                    $this->cant['apro'][$item['id']] = $item['cantidad_aprobada'];
                }
            }
        }else{
            if($this->almacen_tipo == 1 || $this->almacen_tipo == 2){
                $this->items = PedidoDetalleTemp::join('log_insumos as l', 'l.id', 'log_pedidos_detalles_temp.item_id')
                    ->leftjoin('log_catalogo_unidad_medida as um', 'um.id', 'l.catalogoUnidadMedida_id')
                    ->select('l.nombre as nom', 'tarea_id', 'log_pedidos_detalles_temp.precio', 'um.nombre as medida', DB::raw("'0' as tpp"), DB::raw("'0' as eliminar"), DB::raw('0 as compra_id'), DB::raw('1 as estado'),'log_pedidos_detalles_temp.id', 'cantidad', DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles_temp.item_id  and st.almacen_id=log_pedidos_detalles_temp.almacen_id) as en_almacen"))
                    ->where('log_pedidos_detalles_temp.created_by', auth()->user()->id)
                    ->where('log_pedidos_detalles_temp.almacen_tipo', $this->almacen_tipo)
                    ->get();
                
            }elseif($this->almacen_tipo == 3){
                if($this->state['tipo_id'] == 2){
                    $this->items = PedidoDetalleTemp::join('log_equipos as e', 'e.id', 'log_pedidos_detalles_temp.item_id')
                        ->join('log_catalogo_equipos as lc', 'lc.id', 'e.catalogoEquipos_id')
                        ->select('lc.nombre as nom', 'tarea_id', 'p.nombre as partida', 'tarea_id', 'log_pedidos_detalles_temp.precio', DB::raw("'Unidad' as medida"), DB::raw("'0' as tpp"), DB::raw("'0' as eliminar"), 'log_pedidos_detalles_temp.id', DB::raw('0 as compra_id'), DB::raw('1 as estado'), 'cantidad', DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles_temp.item_id  and st.almacen_id=log_pedidos_detalles_temp.almacen_id) as en_almacen"))
                        ->where('log_pedidos_detalles_temp.created_by', auth()->user()->id)
                        ->where('log_pedidos_detalles_temp.almacen_tipo', $this->almacen_tipo)
                        ->where('tipo_movimiento', '=', 2)
                        ->get();
                }else{
                    $this->items = PedidoDetalleTemp::join('log_catalogo_equipos as lc', 'lc.id', 'log_pedidos_detalles_temp.item_id')
                        ->select('lc.nombre as nom', 'tarea_id', 'p.nombre as partida', 'tarea_id', 'log_pedidos_detalles_temp.precio', DB::raw("'Unidad' as medida"), DB::raw("'0' as tpp"), DB::raw("'0' as eliminar"), 'log_pedidos_detalles_temp.id', DB::raw('0 as compra_id'), DB::raw('1 as estado'), 'cantidad', DB::raw("(SELECT stockActual from log_insumos_stock st where st.insumo_id =log_pedidos_detalles_temp.item_id  and st.almacen_id=log_pedidos_detalles_temp.almacen_id) as en_almacen"))
                        ->where('log_pedidos_detalles_temp.created_by', auth()->user()->id)
                        ->where('log_pedidos_detalles_temp.almacen_tipo', $this->almacen_tipo)
                        ->where('tipo_movimiento', '!=', 2)
                        ->get();
                }
                
            }
            if($this->items){
                $this->items = $this->items->pluck(null,'id')->toarray();
            }
        }
    }
    public function aniadir() {
        $this->prod['created_by'] = auth()->user()->id;
        $this->prod['created_at'] = date('Y-m-d H:i');
        $this->validate(['prod.item_id' => 'required|not_in:0', 'prod.partida' => 'required|not_in:0', 'prod.cantidad' => 'required|not_in:0']);
        $data = [
            'item_id' => $this->prod['item_id'],
            'tarea_id' => $this->prod['partida'],
            'cantidad' => $this->prod['cantidad'],
            'almacen_tipo' => $this->almacen_tipo,
            'almacen_id' => $this->almacen_id, 
            'created_by' =>auth()->user()->id, 
            'created_at' => date('Y-m-d H:i:s')];

        try{
            DB::beginTransaction();
            $sav = PedidoDetalleTemp::updateorcreate(
                [ 'item_id' => $data['item_id']]
               , $data
                );
                DB::commit();
                $this->dispatch('alert_info', ['mensaje' => 'Se agregaron agregado correctamente.']);
            }catch(\Exception $e){dd($e);
                DB::rollback();
                $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un error inesperado.']);
            }
            $this->vItems();
    }
    public function render(){
        $this->partidas = Tarea::get();
        $this->trabajadores = VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', 'p.id')
        ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'numeroDocumento AS dni', 'p.id')
        ->where('rrhh_vinculo_laboral.estado', 1)->get();
        $items = Insumo::get();
        return view('livewire.financiero-contable.compras.pedidos.ver-detalles', ['itemss' => $items]);
    }
}
