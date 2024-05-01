<?php
namespace App\Livewire\FinancieroContable\Compras\Ingresos;
use App\Models\FinancieroContable\Compra;
use App\Models\FinancieroContable\CatalogoFormaPago;
use App\Models\FinancieroContable\PedidoDetalle;
use App\Models\FinancieroContable\CompraDetalleTemp;
use App\Models\FinancieroContable\Moneda;
use App\Models\FinancieroContable\CompraComprobante;
use App\Models\FinancieroContable\CatalogoComprobanteCompra;
use App\Models\FinancieroContable\CatalogoDetraccion;
use App\Models\FinancieroContable\IngresoTemp;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use DB;
use App\Http\Controllers\Controller;
use App\Models\FinancieroContable\EquipoTemp;
;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $l, $tipoMov = 1, $proveedor_nom,$nuevo = false, $proveedores,$titulo, $cod, $comprobantes, $compra_id = 0, $almacen_id = 0,$tipoComprobante,$guia_id,$nomAlm, $codTrab, $nomTrab, $ordenes = ['id' =>0],$items = [], $almacen_tipo,$nomAlmDes, $nomProv,$state =['tipo_movimiento' =>1, 'tipo_comprobante' =>0, 'serie' =>'', 'correlativo' =>'', 'fecha_vencimiento' =>null, 'fecha_emision' =>null, 'forma_pago' => '', 'local_id' => 0, 'proveedor_id' =>0], $ver = 0, $showModal = false, $editar = false, $idR, $idSel, $codProy, $nomProy, $aprobar, $ap = [];
    public $formas, $tipos, $detracciones, $monedas, $loc_monedas = [], $moneda_id, $categoria_id, $proveedor_id, $cuotas =0, $total_comp = 0;
    public $comp = ['catalogo_comprobantes_compra_id' => 0, 'catalogo_forma_pago_id' => 0, 'catalogo_detraccion_id' =>0, 'moneda_id' =>0, 'total' =>0, 'porcentaje_igv' => 18];
    public $vertbl = false, $tipo_cambio_fecha, $tipo_cambio, $arr = [], $ccuotas =[], $idTip, $ccc, $ids_ordenes, $ingreso_id, $idRT, $guardado = 0, $idTipo, $comprobantes_ids, $compras_ids, $mov_compra;
    #[On('savPedido')]
    public function editRecurso($id){
        $this->emit('verRecurso',$this->items[$id], $this->ver);
    }
    #[On('editCompTemp')]
    public function editCompTemp($id){
        $this->emit('vCompTemp',$this->comprobantes[$id], 0,$this->ver);
    }
    public function brProv() {	
        $this->nomProv ='';
        $this->state['proveedor_id'] = 0;
    }
    #[On('saveCompTemp')]
    public function saveCompTemp($arr){
        $this->comprobantes[$arr['id']] = $arr;
        $this->calcTotales();
        $this->alert('success', 'Comprobante añadido correctamente.');
    }
    public function calcTotales(){
        $tt = 0;
        foreach ($this->comprobantes as $cc) {
            $tt += $cc['total'];
        }
        $this->total_comp = $tt;
    }
    #[On('savePedDet')]
    public function savePedDet($arr){
        $this->items[$arr['id']] = $arr;
        $this->alert('success', 'Detalle editado correctamente.');
    }
    public function updatedCompFechaEmision(){
        $this->updatedMonedaId();
    }
    public function updatedMonedaId(){
        if($this->moneda_id == 2){
            $obj = new Controller();
            $data = $obj->verTipoCambio($this->comp['fecha_emision']);
            $this->tipo_cambio = $data['valor'];
            $this->tipo_cambio_fecha  = $data['fecha_valor'];
        }
    }
    #[On('rTab')]
    public function rTab(){
        $this->listarOrdenes();
        $this->listarItems();
    }
    public function selProv($id, $nom){
        $this->nomProv = $nom;
        $this->emit('cerrarProv');
        $this->state['proveedor_id'] = $id;
    }
    #[On('selPedido')]
    public function selPedido($id){
        if($this->categoria_id == 3){
            $a = PedidoDetalle::where('compra_id', $id)->get();
            foreach ($a as $b) {
                $c = 0;
                for ($i=0; $i < $b->cantidad; $i++) { 
                    $c ++;
                    $sav = EquipoTemp::updateorcreate([
                        'catalogoEquipos_id' =>  $b->item_id,
                        'compra_id' => $id,
                        'pedido_detalle_id' => $b->id,
                        'almacen_id' => $this->almacen_id,
                        'nro' => $c
                    ],[
                        'pedido_detalle_id' => $b->id,
                        'estado' => 1,
                        'almacen_id' => $this->almacen_id,
                        'created_by' => auth()->user()->id,
                        'created_at' => date('Y-m-d H:i')
                    ]);
                }
                $b->info_id = $sav->id;
                $b->save();
            }
        }
        if($this->tipoMov == 3){
            $sav = IngresoTemp::updateorcreate([
                'tipo_movimiento' =>  $this->tipoMov
            ],[
                'compra_id' =>  $id,
                'tipo_movimiento' =>  $this->tipoMov,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i')
            ]);
        }else{
            $sav = IngresoTemp::updateorcreate([
                'compra_id' =>  $id,
                'tipo_movimiento' =>  $this->tipoMov
            ],[
                'tipo_movimiento' =>  $this->tipoMov,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i')
            ]);
        }
        
        $this->listarOrdenes();
        $this->listarItems();
        $this->emit('vCompras', $this->almacen_id, $this->idSel, $this->state['proveedor_id'], $this->moneda_id);
    }
    public function listarItems(){
        //verificamos si es por compra(1) o por orden(2)
        if($this->tipoMov == 1){
            //verificamos el tipo de almacen (3) equipos (1)(2) insumos y servicios
            if($this->categoria_id == 3){
                //almacen de equipos
                if($this->ver==2 || $this->ver==3){
                    //visualizacion(2) y edicion(3)
                    $items = Equipo::join('log_pedidos_detalles as pd', 'pd.item_id', 'log_equipos.id')
                        ->join('log_compras as c', 'c.id', 'pd.compra_id')
                        ->leftjoin('adm_catalogo_monedas as m', 'm.id', 'c.moneda_id')
                        ->join('log_catalogo_equipos as ce', 'ce.id', 'log_equipos.catalogoEquipos_id')
                        ->select(
                            'pd.id',
                            'pd.compra_id', 
                            'pd.comprobante_id',
                            'simbolo',
                            'log_equipos.id as idItem',
                            'pd.porcentaje_igv',
                            DB::raw("CONCAT(ce.nombre, ' - ', log_equipos.modelo, ' (', log_equipos.numeroSerie , ')') AS nom"), 
                            DB::raw("'1' as cant"), 
                            'pd.com_sin_igv',
                            'com_igv',
                            'com_par_con_igv'
                        )
                        ->where('c.ingreso_id', $this->idSel)
                        ->get();
                }else{
                    //nuevo equipo
                    $items = EquipoTemp::join('log_catalogo_equipos as ce', 'ce.id', 'log_equipos_temp.catalogoEquipos_id')
                        ->select(
                            'log_equipos_temp.compra_id', 
                            'ce.id as idItem',
                            DB::raw("'' as info"), 
                            DB::raw("'' as info_id"), 
                            'log_equipos_temp.id',
                            'porcentaje_igv',
                            'com_par_con_igv',
                            DB::raw("'' as simbolo"), 
                            DB::raw("CONCAT(ce.nombre, ' - ', log_equipos_temp.modelo, ' (', log_equipos_temp.numeroSerie , ')') AS nom"), 
                            DB::raw("'1' as cant"), 
                            'log_equipos_temp.com_sin_igv',
                            'com_con_igv', 'com_par_sin_igv',
                            'com_igv',
                            DB::raw("'UNIDAD' as medida")
                        )
                        ->where('log_equipos_temp.created_by', auth()->user()->id)
                        ->whereRaw('compra_id is null')
                        ->get();
                }
                
            }else{
                if($this->ver == 2 || $this->ver == 3){
                    //visualizacion(2) y edicion(3)
                    $items = PedidoDetalle::join('log_compras as cc', 'cc.id','log_pedidos_detalles.compra_id')
                        ->leftjoin('adm_catalogo_monedas as m', 'm.id', 'cc.moneda_id')
                        ->join('log_insumos as l', 'l.id', 'log_pedidos_detalles.item_id')
                        ->leftjoin('log_catalogo_unidad_medida as u', 'u.id', 'l.catalogoUnidadMedida_id')
                        ->select(
                            'cc.id as compra_id', 
                            'log_pedidos_detalles.id', 
                            'm.simbolo', 
                            'log_pedidos_detalles.comprobante_id', 
                            'l.id as idItem', 
                            'l.nombre as nom', 
                            'com_sin_igv', 
                            'u.nombre as medida', 
                            'porcentaje_igv', 
                            'com_sin_igv', 
                            'com_igv', 
                            'com_con_igv', 'com_par_con_igv', 'com_par_sin_igv',
                            'log_pedidos_detalles.cantidad_aprobada as cant', 
                            'log_pedidos_detalles.porcentaje_igv');
                    if($this->idTipo == 1){
                        $items = $items->join('log_compras as c', 'c.id','log_pedidos_detalles.compra_id')
                            ->where('c.ingreso_id',$this->idSel);
                        
                    }else{
                        $items = $items->where('log_pedidos_detalles.compra_id',$this->idSel);
                    }
                }else{
                    //nuevo ingreso, extrae los temporales
                    $items = IngresoDetalleTemp::join($this->l, 'l.id', 'log_ingresos_detalle_temp.item_id')
                        ->leftjoin('op_partidas_control as p', 'p.id', 'log_ingresos_detalle_temp.partida_id')
                        ->leftjoin('log_catalogo_unidad_medida as um', 'um.id', 'l.catalogoUnidadMedida_id')
                        ->select(
                            'l.nombre as nom',
                            'p.nombre as partida',
                            'l.id as idItem',
                             DB::raw('0 as compra_id'),
                             DB::raw("'' as simbolo"),
                            'log_ingresos_detalle_temp.id',
                            'porcentaje_igv',
                            'cantidad as cant',
                            'log_ingresos_detalle_temp.com_sin_igv',
                            'log_ingresos_detalle_temp.com_igv',
                            'log_ingresos_detalle_temp.com_con_igv',
                            'log_ingresos_detalle_temp.com_par_con_igv',
                            'log_ingresos_detalle_temp.com_par_sin_igv',
                            'um.nombre as medida',
                        )
                        ->where('log_ingresos_detalle_temp.created_by', auth()->user()->id)
                        ->where('log_ingresos_detalle_temp.almacen_tipo', $this->categoria_id);
                }
                $items = $items->get();
            }
        }else{
            if($this->categoria_id == 3){
                $items = PedidoDetalle::join('log_compras as c', 'c.id','log_pedidos_detalles.compra_id')
                    ->join('log_almacenes as a', 'a.id','c.almacen_id')
                    ->join('log_catalogo_equipos as e', 'e.id', 'log_pedidos_detalles.item_id')
                    ->leftjoin('adm_catalogo_monedas as m', 'm.id', 'c.moneda_id')
                    ->select(
                        'log_pedidos_detalles.id as id', 
                        'c.id as compra_id', 
                        'log_pedidos_detalles.comprobante_id', 
                        DB::raw("'0' as idItem"), 
                        'c.correlativo as idc', 
                        'e.nombre as nom', 
                        'com_par_con_igv', 
                        'log_pedidos_detalles.porcentaje_igv', 
                        'log_pedidos_detalles.cantidad_aprobada as cant', 
                        'comprobante_id',
                        'm.nombre as moneda', 'm.simbolo', 'log_pedidos_detalles.info', 'log_pedidos_detalles.info_id')
                    ->whereRaw('log_pedidos_detalles.compra_id is not null')
                    ->where('a.categoria_id', $this->categoria_id);
            }else{
                $items = PedidoDetalle::join('log_compras as c', 'c.id','log_pedidos_detalles.compra_id')
                    ->join('log_almacenes as a', 'a.id','c.almacen_id')
                    ->join($this->l, 'l.id', 'log_pedidos_detalles.item_id')
                    ->leftjoin('adm_catalogo_monedas as m', 'm.id', 'c.moneda_id')
                    ->select(
                        'log_pedidos_detalles.id as id', 
                        'c.id as compra_id', 
                        'log_pedidos_detalles.comprobante_id', 
                        'l.id as idItem', 
                        'c.correlativo as idc', 
                        'l.nombre as nom', 
                        'com_par_con_igv', 
                        'porcentaje_igv', 
                        'log_pedidos_detalles.cantidad_aprobada as cant', 
                        'comprobante_id',
                        'm.nombre as moneda', 'm.simbolo', 'log_pedidos_detalles.info', 'log_pedidos_detalles.info_id')
                    ->whereRaw('compra_id is not null')
                    ->where('a.categoria_id', $this->categoria_id);
            }
            
            if($this->ver == 2 || $this->ver == 3){
                $items = $items->where('c.ingreso_id', $this->ingreso_id);
            }else{
                $items = $items->whereRaw('log_pedidos_detalles.compra_id in (SELECT compra_id from log_ingresos_temp where created_by = '.auth()->user()->id.')');
            }
            $items = $items->get();
            $this->arr = [];
            foreach ($items as $val) {
                $this->arr[$val->id] = $val->comprobante_id;
            }
        }
        if($items){
            $total = $items->pluck('com_par_con_igv')->toarray();
            $this->comp['total'] = array_sum($total);
            $this->compras_ids = $items->pluck('compra_id')->unique()->toArray();
            $this->comprobantes_ids = $items->pluck('comprobante_id')->unique()->toArray();
            $this->items = $items->pluck(null, 'id')->toarray();
        }else{
            $this->items = [];
        }
    }
    public function listarOrdenes(){
        $this->ids_ordenes = [];
        if($this->ver == 2 || $this->ver == 3){
            $this->ordenes = Compra::join('log_almacenes as a', 'a.id', 'log_compras.almacen_id')
                ->leftjoin('adm_catalogo_monedas as m', 'm.id', 'log_compras.moneda_id')
                ->join('rrhh_personas as p', 'p.id', 'log_compras.trabajador_id')
                ->leftjoin('log_catalogo_proveedores as pp', 'pp.id', 'log_compras.proveedor_id')
                ->select(
                    'log_compras.id as idc',
                    'cuotas',
                    'log_compras.correlativo',
                    'pp.id as ruc',
                    'log_compras.moneda_id',
                    'pp.id as idprov',
                    'pp.nombre as prov',
                    'm.nombre as moneda',
                    'fecha1', 'monto1', 'fecha2', 'monto2', 'fecha3', 'monto3', 'fecha4', 'monto4',
                    DB::Raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as solicitante"), 
                    'log_compras.created_at as fecha',
                )
                ->where('log_compras.ingreso_id', $this->ingreso_id)
                ->get(); 
        }else{
            $this->ordenes = Compra::join('log_ingresos_temp as it', 'it.compra_id', 'log_compras.id')
                ->leftjoin('adm_catalogo_monedas as m', 'm.id', 'log_compras.moneda_id')
                ->join('log_almacenes as a', 'a.id', 'log_compras.almacen_id')
                ->join('rrhh_personas as p', 'p.id', 'log_compras.trabajador_id')
                ->join('log_catalogo_proveedores as pp', 'pp.id', 'log_compras.proveedor_id')
                ->select(
                    'log_compras.correlativo',
                    'log_compras.id as idc',
                    'cuotas',
                    'it.id',
                    'pp.id as ruc',
                    'log_compras.moneda_id',
                    'pp.id as idprov',
                    'pp.nombre as prov',
                    'm.nombre as moneda',
                    'fecha1', 'monto1', 'fecha2', 'monto2', 'fecha3', 'monto3', 'fecha4', 'monto4',
                    DB::Raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as solicitante"), 
                    'log_compras.created_at as fecha'
                )
                ->where('a.categoria_id', $this->categoria_id)
                ->where('it.tipo_movimiento', $this->tipoMov)
                ->where('it.created_by', auth()->user()->id)->get();
        }
        if($this->ordenes->count() > 0){
            $this->ids_ordenes = $this->ordenes->pluck('idc');
            $this->ordenes = $this->ordenes->toarray();
            if($this->tipoMov == 3){
                $this->mov_compra = $this->ordenes[0]['idc'];
                $this->cuotas = $this->ordenes[0]['cuotas'];
                $this->ccuotas['f1'] = $this->ordenes[0]['fecha1'];
                $this->ccuotas['m1'] = $this->ordenes[0]['monto1'];
                $this->ccuotas['f2'] = $this->ordenes[0]['fecha2'];
                $this->ccuotas['m2'] = $this->ordenes[0]['monto2'];
                $this->ccuotas['f3'] = $this->ordenes[0]['fecha3'];
                $this->ccuotas['m3'] = $this->ordenes[0]['monto3'];
                $this->ccuotas['f4'] = $this->ordenes[0]['fecha4'];
                $this->ccuotas['m4'] = $this->ordenes[0]['monto4'];
            }
            $this->nomProv = $this->ordenes[0]['prov'];
            $this->state['proveedor_id'] = $this->ordenes[0]['idprov'];
        }else{
            $this->ordenes = [];
        }
    }
    public function updatedtipoMov($id){
        if($id == 1){
            $this->formas = CatalogoFormaPago::get()->toarray();
            $this->tipos = CatalogoComprobanteCompra::get()->toarray();
            $this->detracciones = CatalogoDetraccion::get()->toarray();
        }else{
            $this->listarComprobantes();
            $this->listarOrdenes();
        }
        $this->listarItems();
    }
    #[On('listarComprobantes')]
    public function listarComprobantes(){
        $comprobantes = CompraComprobante::leftjoin('log_catalogo_forma_pago as fp', 'fp.id', 'log_compras_comprobantes.catalogo_forma_pago_id')
            ->leftjoin('adm_catalogo_monedas as m', 'm.id', 'log_compras_comprobantes.moneda_id')    
            ->leftjoin('log_catalogo_comprobantes_compra as cc', 'cc.id', 'log_compras_comprobantes.catalogo_comprobantes_compra_id')
            ->leftjoin('log_catalogo_detracciones as cd', 'cd.id', 'log_compras_comprobantes.catalogo_detraccion_id')
            ->select('log_compras_comprobantes.id',
                'log_compras_comprobantes.temp',
                'log_compras_comprobantes.agregar',
                'log_compras_comprobantes.tipo_cambio',
                'log_compras_comprobantes.fecha_emision',
                'log_compras_comprobantes.fecha_vencimiento',
                'simbolo',
                'serie',
                'correlativo',
                'total',
                'moneda_id',
                'm.nombre as moneda',
                'cd.descripcion as detracc',
                'cc.descripcion as tipo',
                'fp.descripcion as forma',
                'catalogo_comprobantes_compra_id',
                'catalogo_forma_pago_id',
                'porcentaje_igv',
                DB::raw("'1' as tpp"),
                'eliminar'
            );
        if($this->ver == 1){
            $comprobantes = $comprobantes->whereRaw('(temp = '.auth()->user()->id.' or agregar = '.auth()->user()->id.')');
        }elseif($this->ver == 2){
            if($this->tipoMov == 3){
                $comprobantes = $comprobantes->whereIn('log_compras_comprobantes.compra_id', $this->compras_ids);
            }else{
                $comprobantes = $comprobantes->whereIn('log_compras_comprobantes.id', $this->comprobantes_ids);
            }
        }elseif($this->ver == 3){
            if($this->tipoMov == 3){
                $comprobantes = $comprobantes->whereIn('log_compras_comprobantes.compra_id', $this->compras_ids)->orWhere(function ($query) {
                    $query->where('temp', auth()->user()->id)
                        ->orWhere('agregar', auth()->user()->id);
                });
            }else{
                $comprobantes = $comprobantes->whereIn('log_compras_comprobantes.id', $this->comprobantes_ids)->orWhere(function ($query) {
                    $query->where('temp', auth()->user()->id)
                        ->orWhere('agregar', auth()->user()->id);
                });
            }
        }
        $comprobantes = $comprobantes->get();
        $this->total_comp = $comprobantes->sum('total');
        if($comprobantes){
            $this->comprobantes = $comprobantes->pluck(null, 'id')->toarray();
        }else{
            $this->comprobantes = null;
        }
    }
    public function mount(){
        $this->formas = CatalogoFormaPago::get()->toarray();
        $this->tipos = CatalogoComprobanteCompra::get()->toarray();
        $this->detracciones = CatalogoDetraccion::get()->toarray();
        
    }
    #[On('nuevo')]
    public function ver($id = 0, $loc, $tp = 1, $igv = 18){
        $this->monedas = Moneda::whereIn('id', $this->loc_monedas)->get()->toarray();
        $this->ver = $tp;
        $this->guardado = 0;
        $this->idSel = $id;
        $this->almacen_id = $loc;
        $this->moneda_id = 0;
        $this->cuotas = 0;
        $this->ccuotas = ['f1' => date('Y-m-d'), 'm1' => '', 'f2' => date('Y-m-d'), 'm2' => '', 'f3' => date('Y-m-d'), 'm3' => '', 'f4' => date('Y-m-d'), 'm4' => ''];
        $this->ordenes = [];
        $this->comprobantes = [];
        $this->items = [];
        $nn = Local::join('log_almacenes as a', 'a.local_id', 'adm_locales.id')
            ->join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'a.categoria_id')
            ->select('adm_locales.id', 'adm_locales.nombre', 'codigoProyecto', 'a.nombre as almacen', 'a.categoria_id', 'cc.tipo', 'monedaPrin', 'monedaSec')
            ->where('a.id', $loc)->first();
        $this->almacen_tipo= $nn->tipo;
        $this->codProy = $nn->codigoProyecto;
        $this->nomProy = $nn->nombre;
        $this->nomAlm = $nn->almacen;
        $this->categoria_id = $nn->categoria_id;
        $this->loc_monedas = [$nn->monedaPrin, $nn->monedaSec];
        if($this->almacen_tipo == 1 || $this->almacen_tipo == 2){
            $this->l = 'log_insumos as l';
        }elseif($this->almacen_tipo == 3){
            if($this->tipoMov == 1){
                $this->l = 'log_equipos_temp as l';
            }else{
                $this->l = 'log_catalogo_equipos as l';
            }
        }
        if($tp == 1){
            $this->ingreso_id = 0;
            $this->titulo = "Nuevo Ingreso";
            $this->editar = false;
            $this->items = [];
            $this->compra_id = 0;
            $this->tipoMov = 1;
            $this->nomProv = '';
            $this->state = ['tipo_movimiento' =>1, 'proveedor_id' => 0, 'almacen_id' => $this->almacen_id, 'tipo_comprobante' =>0, 'serie' =>'', 'total' => 0, 'fecha_vencimiento' =>date('Y-m-d'), 'fecha_emision' =>date('Y-m-d'), 'forma_pago_id' => 1];
            $this->comp = ['porcentaje_igv' =>$igv, 'correlativo' => '', 'catalogo_comprobantes_compra_id' => 0, 'catalogo_forma_pago_id' => 0, 'catalogo_detraccion_id' =>0, 'moneda_id' =>0, 'total' =>0, 'fecha_vencimiento' =>date('Y-m-d'), 'fecha_emision' =>date('Y-m-d')];
            $this->monedas = Moneda::whereIn('id', $this->loc_monedas)->get()->toarray();
            $this->listarItems();
        }elseif($tp == 2 || $tp == 3){
            if($tp == 3){
                $this->titulo = "Edición de Ingreso";
                $this->editar = true;
            }else{
                $this->titulo = "Visualizacion de Ingreso";
                $this->editar = false;
            }
            $compra = Ingreso::leftjoin('log_catalogo_proveedores as p', 'p.id', 'log_ingresos.proveedor_id')
                ->select('proveedor_id', 'p.nombre', 'log_ingresos.tipo_movimiento', 'log_ingresos.id')->where('log_ingresos.id', $this->idSel)->first();
            $this->comp['proveedor_id'] = $compra->proveedor_id;
            $this->state['proveedor_id'] = $compra->proveedor_id;
            $this->nomProv = $compra->nombre;
            $this->idTipo = $compra->tipo_movimiento;
            $this->tipoMov = $compra->tipo_movimiento;

            if($compra->tipo_movimiento == 1){
                $comp = CompraComprobante::leftjoin('log_catalogo_proveedores as p', 'p.id', 'log_compras_comprobantes.proveedor_id')
                    ->select('catalogo_comprobantes_compra_id', 'porcentaje_igv', 'serie', 'correlativo', 'catalogo_forma_pago_id', 'fecha_emision', 'fecha_vencimiento', 'catalogo_detraccion_id', 'total', 'moneda_id')
                    ->where('log_compras_comprobantes.ingreso_id', $this->idSel)->first();
                $this->moneda_id = $comp->moneda_id;
                $this->comp['catalogo_comprobantes_compra_id'] = $comp->catalogo_comprobantes_compra_id;
                $this->comp['serie'] = $comp->serie;
                $this->comp['correlativo'] = $comp->correlativo;
                $this->comp['porcentaje_igv'] = $comp->porcentaje_igv;
                $this->comp['catalogo_forma_pago_id'] = $comp->catalogo_forma_pago_id;
                $this->comp['fecha_emision'] = $comp->fecha_emision;
                $this->comp['fecha_vencimiento'] = $comp->fecha_vencimiento;
                $this->comp['catalogo_detraccion_id'] = $comp->catalogo_detraccion_id;
                $this->comp['total'] = $comp->total;
                $this->listarItems();
            }else{
                $this->ingreso_id = $compra->id;
                $this->listarItems();
                $this->listarComprobantes();
                $this->listarOrdenes();
            }
        }
        $this->emit('rlTblTemp', $id, $tp);
        $this->showModal = true;
    }
    private function guardarEquiposTemp($tp, $det = 0){
        if($tp == 1){
                $can = EquipoTemp::where('created_by', auth()->user()->id)
                    ->where('almacen_id', $this->almacen_id)
                    ->whereRaw('compra_id is null')->get();
                $idcc=  $this->ccc->id;
            
            foreach ($can as $temp) {
                    $sav = Equipo::create([
                        'catalogoEquipos_id' => $temp->catalogoEquipos_id,
                        'categoria_id' => $temp->categoria_id,
                        'compra_id' => $this->compra_id,
                        'catalogoColor_id' => $temp->catalogoColor_id,
                        'catalogoMarca_id' => $temp->catalogoMarca_id,
                        'modelo' => $temp->modelo,
                        'estado' => $temp->estado,
                        'numeroSerie' => $temp->numeroSerie,
                        'imagen' => $temp->imagen, 
                        'certificacion' => $temp->certificacion,
                        'observaciones' => $temp->observaciones,
                        'mantenimiento' => $temp->mantenimiento,
                        'created_at' => date('Y-m-d H:i'),
                        'created_by' => auth()->user()->id,
                    ]);
                    if($this->tipoMov == 1 ){
                        $sav1 = PedidoDetalle::create([
                            'compra_id' => $this->compra_id,
                            'comprobante_id' => $idcc,
                            'item_id' => $sav->id,
                            'item_tipo' => 3,
                            'partida_id' => $temp->partida_id,
                            'almacen_id' => $temp->almacen_id,
                            'porcentaje_igv' => $temp->porcentaje_igv,
                            'cantidad_aprobada' => 1,
                            'valor_igv' => $temp->valor_igv,
                            'com_sin_igv' => $temp->com_sin_igv,
                            'com_igv' => $temp->com_igv,
                            'com_con_igv' => $temp->com_con_igv,
                            'com_par_sin_igv' => $temp->com_par_sin_igv,
                            'com_par_con_igv' => $temp->com_par_con_igv, 
                            'estado' => 2, 
                            'created_by' => auth()->user()->id, 
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                $rotacion = [];
                if ($sav) {
                    $this->equipos_id = $sav->id;
                    $rotacion['equipo_id'] = $this->equipos_id;
                    $rotacion['origen_id'] = 0;
                    $rotacion['tipoOrigen'] = 0;
                    $rotacion['autoriza_id'] = 0;
                    $rotacion['destino_id'] = $this->almacen_id;
                    $rotacion['tipoDestino'] = 1;
                    $rotacion['fechaRotacion'] = date('Y-m-d H:i:s');
                    $rotacion['columna'] = $temp->columna;
                    $rotacion['nivel'] = $temp->nivel;
                    $rotacion['estado'] = 1;
                    $rotacion['created_by'] = auth()->user()->id;
                    $rotacion['created_at'] = date('Y-m-d H:i:s');
                    $sav = EquipoRotacion::create($rotacion);
                }
            }
            $del= EquipoTemp::where('created_by', auth()->user()->id)->where('almacen_id', $this->almacen_id)->whereRaw('compra_id is null')->delete();       
            return true;
        }else{
            $temp = EquipoTemp::where('pedido_detalle_id', $det)->first();
            $sav = Equipo::create([
                'catalogoEquipos_id' => $temp->catalogoEquipos_id,
                'categoria_id' => $temp->categoria_id,
                'compra_id' => $temp->compra_id,
                'catalogoColor_id' => $temp->catalogoColor_id,
                'catalogoMarca_id' => $temp->catalogoMarca_id,
                'modelo' => $temp->modelo,
                'estado' => $temp->estado,
                'numeroSerie' => $temp->numeroSerie,
                'imagen' => $temp->imagen, 
                'certificacion' => $temp->certificacion,
                'observaciones' => $temp->observaciones,
                'mantenimiento' => $temp->mantenimiento,
                'created_at' => date('Y-m-d H:i'),
                'created_by' => auth()->user()->id,
            ]);
            if ($sav) {
                $this->equipos_id = $sav->id;
                $rotacion['equipo_id'] = $this->equipos_id;
                $rotacion['origen_id'] = 0;
                $rotacion['tipoOrigen'] = 0;
                $rotacion['autoriza_id'] = 0;
                $rotacion['destino_id'] = $this->almacen_id;
                $rotacion['tipoDestino'] = 1;
                $rotacion['fechaRotacion'] = date('Y-m-d H:i:s');
                $rotacion['columna'] = $temp->columna;
                $rotacion['nivel'] = $temp->nivel;
                $rotacion['estado'] = 1;
                $rotacion['created_by'] = auth()->user()->id;
                $rotacion['created_at'] = date('Y-m-d H:i:s');
                $sav = EquipoRotacion::create($rotacion);
            }
            $temp = EquipoTemp::where('pedido_detalle_id', $det)->delete();
            return $sav->id;
        }
        
    }
    public function guardar() {
        if($this->tipoMov == 1){
            if($this->comp['catalogo_comprobantes_compra_id'] != 99){
                $this->validate(['state.proveedor_id' => 'required|not_in:0', 'moneda_id' => 'required|not_in:0', 'comp.catalogo_comprobantes_compra_id' => 'required|not_in:0', 'comp.catalogo_forma_pago_id' => 'required|not_in:0', 'comp.serie' => 'required', 'comp.correlativo' => 'required|not_in:0', 'comp.fecha_emision' => 'required', 'comp.fecha_vencimiento' => 'required']);
            }else{
                if(!$this->comp['total']){
                    $this->alert('error', 'No se puede guardar total en 0');
                }else{
                    $this->validate(['moneda_id' => 'required|not_in:0', 'comp.catalogo_comprobantes_compra_id' => 'required|not_in:0','comp.total' => 'required|not_in:0']);
                }
            }
            if($this->moneda_id == 2){
                $this->validate(['tipo_cambio' => 'required|not_in:0']);
                $this->comp['tipo_cambio'] = $this->tipo_cambio;
                $this->comp['tipo_cambio_fecha'] = $this->tipo_cambio_fecha;
            }else{
                $this->comp['tipo_cambio'] = 1;
                $obj = new Controller();
                $data = $obj->verTipoCambio(date('Y-m-d'));
                $this->comp['tipo_cambio'] = $data['valor'];
            }
        }elseif($this->tipoMov == 3){
            if($this->cuotas == 1){
                $this->validate(['ccuotas.f1' => 'required', 'ccuotas.m1' => 'required|not_in:0']);
            }
            if($this->cuotas == 2){
                $this->validate(['ccuotas.f1' => 'required', 'ccuotas.m1' => 'required|not_in:0', 'ccuotas.f2' => 'required', 'ccuotas.m2' => 'required|not_in:0']);
            }
            if($this->cuotas == 3){
                $this->validate(['ccuotas.f1' => 'required', 'ccuotas.m1' => 'required|not_in:0', 'ccuotas.f2' => 'required', 'ccuotas.m2' => 'required|not_in:0', 'ccuotas.f3' => 'required', 'ccuotas.m3' => 'required|not_in:0']);
            }
            if($this->cuotas == 4){
                $this->validate(['ccuotas.f1' => 'required', 'ccuotas.m1' => 'required|not_in:0', 'ccuotas.f2' => 'required', 'ccuotas.m2' => 'required|not_in:0', 'ccuotas.f3' => 'required', 'ccuotas.m3' => 'required|not_in:0', 'ccuotas.f4' => 'required', 'ccuotas.m4' => 'required|not_in:0']);
            }
            $obj = new Controller();
                $data = $obj->verTipoCambio(date('Y-m-d'));
                $this->comp['tipo_cambio'] = $data['valor'];
        }else{
            $this->validate(['state.proveedor_id' => 'required|not_in:0']);
            $obj = new Controller();
                $data = $obj->verTipoCambio(date('Y-m-d'));
                $this->comp['tipo_cambio'] = $data['valor'];
        }
        $this->state['tipo_movimiento'] = $this->tipoMov;
        try{
            DB::beginTransaction();
                if($this->tipoMov == 1){
                    if(!$this->comp['correlativo']){$this->comp['correlativo'] = null;}
                    $this->state['ingreso_tipo'] = 1;
                    $this->state['created_ingreso_by'] = auth()->user()->id;
                    $this->state['created_ingreso_at'] = date('Y-m-d H:i');
                    $this->state['fecha'] = date('Y-m-d H:i');
                    $err = 0;
                    $this->state['trabajador_id'] = auth()->user()->id;
                    $this->state['empresa_id'] = 1;
                    $this->state['moneda_id'] = $this->moneda_id;
                    $this->state['empresa_id'] = 1;
                    $this->state['estado'] = 2;
                    $this->state['fecha_entrega'] = date('Y-m-d H:i');
                    $this->state['created_by'] = auth()->user()->id;
                    $this->state['created_at'] = date('Y-m-d H:i');
                    if($this->editar){
                        $sav = CompraComprobante::where('ingreso_id', $this->idSel)->update([
                            'serie' => $this->comp['serie'],
                            'porcentaje_igv' => $this->comp['porcentaje_igv'],
                            'correlativo' => $this->comp['correlativo'],
                            'catalogo_forma_pago_id' => $this->comp['catalogo_forma_pago_id'],
                            'catalogo_comprobantes_compra_id' => $this->comp['catalogo_comprobantes_compra_id'],
                            'fecha_emision' => $this->comp['fecha_emision'],
                            'fecha_vencimiento' => $this->comp['fecha_vencimiento'],
                            'catalogo_detraccion_id' => $this->comp['catalogo_detraccion_id'],
                            'moneda_id' => $this->moneda_id,
                            'tipo_cambio' => $this->tipo_cambio,
                            'tipo_cambio_fecha' => $this->tipo_cambio_fecha
                        ]);
                        foreach ($this->items as $itt) {
                            $sav = PedidoDetalle::find($itt['id']);
                                $sav->valor_igv = ($itt['com_par_con_igv']-$itt['com_par_sin_igv']);
                                $sav->com_sin_igv = $itt['com_sin_igv'];
                                $sav->com_con_igv = $itt['com_con_igv'];
                                $sav->porcentaje_igv = $itt['porcentaje_igv'];
                                $sav->com_par_con_igv = $itt['com_par_con_igv'];
                                $sav->com_par_sin_igv = $itt['com_par_sin_igv'];
                            $sav->save();
                        }
                        $this->alert('success', 'Ingreso editado correctamente.');
                        $this->emit('renderizar');
                    }else{
                        if($this->almacen_tipo == 3){
                            $can = EquipoTemp::where('created_by', auth()->user()->id)
                                ->whereRaw('compra_id is null')
                                ->get();
                        }else{
                            $can = IngresoDetalleTemp::select('com_sin_igv', 'cantidad', 'porcentaje_igv')
                                ->where('created_by', auth()->user()->id)
                                ->where('almacen_tipo', $this->almacen_tipo)
                                ->get();
                        }
                        if($can->count()>0){
                            if($can->where('porcentaje_igv', '!=', $this->comp['porcentaje_igv'])->count()){
                                $err = 3;
                            }else{
                                $this->state['total'] = $this->comp['total'];
                                $sav = Ingreso::create(['almacen_id' => $this->almacen_id, 'proveedor_id' => $this->state['proveedor_id'], 'tipo_movimiento' => $this->state['tipo_movimiento'],'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i:s')]);
                                $this->comp['ingreso_id'] = $sav->id;
                                $this->state['ingreso_id'] = $sav->id;
                                $sav = Compra::create($this->state);
                                if($this->tipoMov == 3){
                                    $this->comp['compra_id'] = $sav->id;
                                }
                                $this->comp['estado'] = 1;
                                $this->comp['proveedor_id'] = $this->state['proveedor_id'];
                                $this->comp['moneda_id'] = $this->moneda_id;
                                $this->comp['created_by'] = auth()->user()->id;
                                $this->comp['created_at'] = date('Y-m-d H:i');
                                $this->ccc = CompraComprobante::create($this->comp);
                                $this->state['total_pendiente'] = $can->sum('cantidad*com_sin_igv');
                                $this->compra_id = $sav->id;
                                if($sav){
                                    if($this->almacen_tipo == 3){
                                        $this->guardarEquiposTemp($this->tipoMov);
                                    }else{
                                        DB::table('log_pedidos_detalles')->insertUsing(['item_tipo', 'compra_id', 'comprobante_id','item_id', 'partida_id', 'valor_igv', 'porcentaje_igv', 'almacen_id', 'cantidad_aprobada', 'com_sin_igv', 'com_igv', 'com_con_igv', 'com_par_sin_igv', 'com_par_con_igv', 'estado', 'created_by', 'created_at'],
                                            function ($query) {
                                                $query->select([DB::raw($this->almacen_tipo), DB::raw($this->compra_id), DB::raw($this->ccc->id),'item_id', 'partida_id', 'valor_igv', 'porcentaje_igv', DB::raw($this->almacen_id), 'cantidad', 'com_sin_igv', 'com_igv', 'com_con_igv', 'com_par_sin_igv', 'com_par_con_igv', DB::raw('2'), DB::raw(auth()->user()->id), DB::raw("'".now()."'")])
                                                    ->from('log_ingresos_detalle_temp')
                                                    ->where('created_by', auth()->user()->id)
                                                    ->where('almacen_tipo', $this->almacen_tipo);
                                            }
                                        );
                                        $del = IngresoDetalleTemp::where('created_by', auth()->user()->id)
                                            ->where('almacen_tipo', $this->almacen_tipo)->delete();
                                    }
                                }
                            }
                        }else{
                            $err = 1;
                        }
                        if($err == 1){
                            $this->alert('error', 'Debes agregar almenos 01 recurso');
                        }elseif($err == 2){
                            $this->alert('error', 'Debes agregar almenos 01 comprobante/recibo');
                        }elseif($err == 3){
                            $this->alert('error', 'Valor del IGV de los items no coinciden con el comprobante');
                        }else{
                            if($this->almacen_tipo == 1 || $this->almacen_tipo == 2){
                                $data = PedidoDetalle::join($this->l, 'l.id', '=', 'log_pedidos_detalles.item_id')
                                    ->where('compra_id', $this->compra_id)
                                    ->get();
                            }
                            $this->alert('success', 'Ingreso guardado correctamente.');
                            $this->showModal = false;
                            $this->emit('renderizar');
                        } 
                    }    
                }elseif($this->tipoMov == 2 || $this->tipoMov == 3){
                    if(count($this->arr) < 1){
                        $this->alert('error', 'Debes seleccionar almenos 01 orden');
                    }elseif(empty($this->comprobantes)){
                        $this->alert('error', 'Debes agregar almenos 01 comprobante de pago');
                    }elseif(number_format($this->total_comp, 2) != number_format($this->comp['total'], 2)){
                        $this->alert('error', 'El monto total(Comprobantes) no concide con el detalle(Items)');
                    }else{
                        if($this->editar){
                            $ccTemp = [];
                            $ArrC = ['cuotas' => $this->cuotas];
                            $c = 1;
                            foreach($this->comprobantes as $comp){
                                if($comp['eliminar']){
                                    $del = CompraComprobante::where('id', $comp['id'])->delete();
                                }else{
                                    $compraComprobante = CompraComprobante::find($comp['id']);
                                    $ccTemp[] = $comp;
                                    if($comp['temp']){
                                        if($this->tipoMov == 3){
                                            $ArrC['cuota'.$c] = $comp['id'];
                                            $compraComprobante->update(['temp' => 0, 'compra_id' => $this->mov_compra]);
                                        }else{
                                            $compraComprobante->update(['temp' => 0]);
                                        }
                                    }elseif($comp['agregar']){
                                        if($this->tipoMov == 3){
                                            $ArrC['cuota'.$c] = $comp['id'];
                                            $compraComprobante->update(['agregar' => 0, 'compra_id' => $this->mov_compra]);
                                        }else{
                                            $compraComprobante->update(['agregar' => 0]);
                                        }
                                    }else{
                                        if(!isset($comp['fecha_emision'])){
                                            $comp['fecha_emision'] = null;
                                        }
                                        if(!isset($comp['fecha_vencimiento'])){
                                            $comp['fecha_vencimiento'] = null;
                                        }
                                        if(!isset($comp['catalogo_detraccion_id'])){
                                            $comp['catalogo_detraccion_id'] = 0;
                                        }
                                        if(!isset($comp['tipo_cambio'])){
                                            $comp['tipo_cambio'] = 0;
                                        }
                                        if($this->tipoMov == 3){
                                            $compraComprobante->compra_id = $this->mov_compra;
                                            $ArrC['cuota'.$c] = $comp['id'];
                                        }
                                        $compraComprobante->serie = $comp['serie']; 
                                        $compraComprobante->correlativo = $comp['correlativo'];
                                        $compraComprobante->catalogo_comprobantes_compra_id = $comp['catalogo_comprobantes_compra_id'];
                                        $compraComprobante->catalogo_forma_pago_id = $comp['catalogo_forma_pago_id'];
                                        $compraComprobante->fecha_emision = $comp['fecha_emision'];
                                        $compraComprobante->fecha_vencimiento = $comp['fecha_vencimiento'];
                                        $compraComprobante->catalogo_detraccion_id = $comp['catalogo_detraccion_id'];
                                        $compraComprobante->porcentaje_igv = $comp['porcentaje_igv'];
                                        $compraComprobante->moneda_id = $comp['moneda_id'];
                                        $compraComprobante->tipo_cambio = $comp['tipo_cambio'];
                                        $compraComprobante->total = $comp['total'];
                                        $compraComprobante->save();
                                    }
                                }
                                $c++;
                            }
                            if($this->tipoMov == 3){
                                for ($i = 1; $i <=$this->cuotas; $i++) { 
                                    $ArrC['monto'.$i] = $this->ccuotas['m'.$i];
                                    $ArrC['fecha'.$i] = $this->ccuotas['f'.$i];
                                }
                                $savv = Compra::where('id', $this->mov_compra)->update($ArrC);
                            }
                            $cantc=count($ccTemp);
                            if($cantc == 1){ $idcc = $ccTemp[0]['id'];}

                            foreach ($this->arr as $key => $itm) {
                                $pedidoDetalle = PedidoDetalle::find($key);
                                if ($pedidoDetalle) {
                                    if($cantc == 1){ $itm = $idcc; }
                                    $pedidoDetalle->update(['comprobante_id' => $itm]);
                                }
                            }
                            $this->alert('success', 'Ingreso editado correctamente');
                            $this->emit('renderizar');
                        }else{
                            $ArrC = [];
                            $can = CompraComprobante::whereRaw('(temp = '.auth()->user()->id.' or agregar = '.auth()->user()->id.')')->get();
                            $cantc=$can->count();
                            if($cantc == 1){ $idcc = $can->first()->id;}
                            if($can && !$this->ingreso_id){
                                $sav = Ingreso::create(['almacen_id' => $this->almacen_id, 'proveedor_id' => $this->state['proveedor_id'], 'tipo_movimiento' => $this->state['tipo_movimiento'],'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i:s')]);
                                $this->ingreso_id = $sav->id;
                                if($this->tipoMov == 3){
                                    $up = Compra::find($this->mov_compra);
                                        $up->ingreso_id = $this->ingreso_id;
                                        $up->tipo_movimiento = $this->tipoMov;
                                        $up->tipo_cambio = $this->comp['tipo_cambio'];
                                        if($this->cuotas == 1){
                                            $up->monto1 = $this->ccuotas['m1'];
                                            $up->fecha1 = $this->ccuotas['f1'];
                                        }elseif($this->cuotas == 2){
                                            $up->monto1 = $this->ccuotas['m1'];
                                            $up->monto2 = $this->ccuotas['m2'];
                                            $up->fecha1 = $this->ccuotas['f1'];
                                            $up->fecha2 = $this->ccuotas['f2'];
                                        }elseif($this->cuotas == 3){
                                            $up->monto1 = $this->ccuotas['m1'];
                                            $up->monto2 = $this->ccuotas['m2'];
                                            $up->monto3 = $this->ccuotas['m3'];
                                            $up->fecha1 = $this->ccuotas['f1'];
                                            $up->fecha2 = $this->ccuotas['f2'];
                                            $up->fecha3 = $this->ccuotas['f3'];
                                        }elseif($this->cuotas == 4){
                                            $up->monto1 = $this->ccuotas['m1'];
                                            $up->monto2 = $this->ccuotas['m2'];
                                            $up->monto3 = $this->ccuotas['m3'];
                                            $up->monto4 = $this->ccuotas['m4'];
                                            $up->fecha1 = $this->ccuotas['f1'];
                                            $up->fecha2 = $this->ccuotas['f2'];
                                            $up->fecha3 = $this->ccuotas['f3'];
                                            $up->fecha4 = $this->ccuotas['f4'];
                                        }
                                        $up->created_ingreso_by = auth()->user()->id;
                                        $up->created_ingreso_at = date('Y-m-d H:i:s');
                                    $up->save();
                                }else{
                                    $up = Compra::whereIn('id', $this->ids_ordenes)->update(['tipo_cambio' => $this->comp['tipo_cambio'],  'ingreso_id' => $this->ingreso_id, 'tipo_movimiento' => 2, 'created_ingreso_by' => auth()->user()->id, 'created_ingreso_at' => date('Y-m-d H:i:s')]);
                                }
                                $ArrC = [];
                                if($this->tipoMov == 2 ){
                                    foreach ($this->arr as $key => $itm) {
                                        $pedidoDetalle = PedidoDetalle::find($key);
                                        if ($pedidoDetalle) {
                                            if($cantc == 1){ $itm = $idcc; }
                                            if($this->almacen_tipo == 3){
                                                $equipo = $this->guardarEquiposTemp($this->tipoMov, $key);
                                                $pedidoDetalle->update(['comprobante_id' => $itm, 'item_equipo_id' => $equipo]);
                                            }else{
                                                $pedidoDetalle->update(['comprobante_id' => $itm]);
                                            }
                                            $sav1 = CompraComprobante::find($itm);
                                            if($sav1){
                                                if($this->tipoMov == 3){
                                                    $sav1->update(['proveedor_id' => $this->state['proveedor_id'], 'ingreso_id' => $this->ingreso_id, 'compra_id' => $this->mov_compra, 'temp' => 0, 'agregar' => 0]);
                                                }else{
                                                    $sav1->update(['proveedor_id' => $this->state['proveedor_id'], 'temp' => 0, 'agregar' => 0]);
                                                }
                                                $sav1->save();
                                            }
                                        }
                                        if($this->almacen_tipo == 1){
                                            $ins = InsumoStock::where('insumo_id', $pedidoDetalle->item_id)->where('almacen_id', $this->almacen_id)->first();
                                            if($ins){$cant = $ins->stockActual;}else {$cant=0;}
                                            InsumoStock::updateOrCreate(
                                                [
                                                    'insumo_id' => $pedidoDetalle->item_id,
                                                    'almacen_id' => $this->almacen_id
                                                ], [
                                                    'stockActual' => $cant + $pedidoDetalle->cantidad_aprobada,
                                                    'created_by' => auth()->user()->id,
                                                    'created_at' => date('Y-m-d H:i')
                                                ]
                                            );
                                            $kardex = InsumoKardex::updateorcreate([
                                                    'insumo_id' => $pedidoDetalle->item_id,
                                                    'compra_id' => $pedidoDetalle->compra_id,
                                                    'almacen_id' => $this->almacen_id,
                                                ],[
                                                    'insumo_id' => $pedidoDetalle->item_id,
                                                    'compra_id' => $pedidoDetalle->compra_id,
                                                    'almacen_id' => $this->almacen_id,
                                                    'tipo' => 1,
                                                    'entrada' => $pedidoDetalle->cantidad_aprobada,
                                                    'stockActual' => $cant + $pedidoDetalle->cantidad_aprobada,
                                                    'created_by' => auth()->user()->id,
                                                    'created_at' => date('Y-m-d')
                                                ]);
                                        }
                                    }
                                    $this->arr = [];
                                }else{
                                    $c = 1;
                                    foreach ($this->comprobantes as $val) {
                                        $ArrC['cuota'.$c] = $val['id'];
                                        $sav1 = CompraComprobante::find($val['id']);
                                        $sav1->update(['proveedor_id' => $this->state['proveedor_id'], 'ingreso_id' => $this->ingreso_id, 'compra_id' => $this->mov_compra, 'temp' => 0, 'agregar' => 0]);
                                        $c++;
                                    }
                                    if($this->cuotas>0){
                                        $savv = Compra::where('id', $this->mov_compra)->update($ArrC);
                                    }
                                    if($this->almacen_tipo == 3){
                                        foreach ($this->items as $item) {
                                            $this->guardarEquiposTemp(2, $item['id']);
                                        }
                                    }
                                    
                                }
                                $del3 = IngresoTemp::whereIn('compra_id', $this->ids_ordenes)->delete();
                                $this->alert('success', 'Ingreso guardado correctamente');
                            }
                        } 
                        $this->showModal = false;
                        $this->emit('renderizar');
                    }
                }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->alert('error', 'Ocurrio un error inesperado.');
        }
    }
    public function delCompraTemp($id){
        $this->idR = $id;
        
        $this->confirm('¿Desea eliminar la OC/OS: #'.$id.'?', [
            'onConfirmed' => 'brCompraTemp',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    #[On('brCompraTemp')]
    public function brCompraTemp(){
        $data = IngresoTemp::where('id', $this->idR)->delete();
        if($data){
            $this->rTab();
            $this->alert('success', 'OC/OS retirado correctamente');
        }else{
            $this->alert('error', 'Error inesperado');
        }
    }
    #[On('delItemTemp')]
    public function delItemTemp($id, $tp){
        $this->idR = $id;
        $this->idTip = $tp;
        $this->confirm('¿Desea eliminar el Item: #'.$id.'?', [
            'onConfirmed' => 'brItemTemp',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    #[On('brItemTemp')]
    public function brItemTemp(){
        if($this->idTip == 1){
            if($this->almacen_tipo == 3){
                $cam= EquipoTemp::where('id', $this->idR)->delete();
            }else{
                $cam= IngresoDetalleTemp::where('id', $this->idR)->delete();
            }
            
        }else{
            $cam= CompraDetalleTemp::where('id', $this->idR)->delete();
        }
        $this->listarItems();
        $this->alert('success', 'Item eliminado correctamente');
    }
    public function render() {
        return view('livewire.financiero-contable.compras.ingresos.ver-detalles');
    }
}