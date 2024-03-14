<?php

namespace App\Livewire\FinancieroContable\Compras\Pedidos\Components;

use App\Models\FinancieroContable\PedidoDetalle;
use App\Models\FinancieroContable\PedidoDetalleTemp;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\FinancieroContable\IngresoDetalleTemp;
use App\Models\FinancieroContable\Almacen;
use App\Models\FinancieroContable\CompraDetalleTemp;
use DB;
class ListarItems extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $state = ['partida_id' =>0], $tp, $ubicaciones, $tp_mov, $ubicacion, $almacen, $categoria = 0,$search,$titulo, $tipo = 1, $items = [], $itemSel;
    public $igv;
    #[On('rtabla2')]
    public function rtabla2($nom){
        $this->search = $nom;
        $this->emit('rtablaItems', $this->tipo, $this->state['almacen_id'], $nom, $this->tp, $this->tp_mov);     
    }
    public function calcPrecio($id){
        $d = PedidoDetalle::selectRaw('avg(com_igv) as media')
            ->where('item_tipo', $this->tp_mov)
            ->where('item_id', $id)
            ->where('precio', '>', 0)
            ->groupBy('item_id')
            ->first();
        if($d){
            return $d->media;
        }else{
            return 0;
        }
    }
    #[On('selItem')]
    public function selItem($id, $nom){
        $this->itemSel[$id]['nom'] = $id.' - '.$nom;
        $this->itemSel[$id]['id'] = $id;
        $this->itemSel[$id]['cant'] = $this->tipo==3?1:0;
        $this->itemSel[$id]['partida'] = 0;
        $this->itemSel[$id]['com_sin_igv'] = number_format($this->calcPrecio($id), 2);
        //$this->state['item_id'] = $id;
    }
    #[On('delItem')]
    public function delItem($id){
        unset($this->itemSel[$id]);
        $this->alert('success', 'Item retirado correctamente.');
    }
    #[On('vItems')]
    public function ver($tp, $id, $tp_mov, $almacen, $igv = 18){
        $this->tp = $tp;
        $this->igv = $igv;
        if($tp ==1 && $tp_mov == 2){
            $this->alert('error', 'Debes seleccionar un almacen');
        }else{
            $this->almacen = $almacen;
            
            $this->state['partida_id'] = 0;
            $this->state['almacen_id'] = $almacen;
            $this->state['item_id'] = 0;
            $this->itemSel = [];
            $this->tp_mov = $tp_mov;
            $this->search = '';
            $this->categoria = 0;
            $this->rtabl(0);
            $nn = Almacen::join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'log_almacenes.categoria_id')
                ->select('tipo')
                ->where('log_almacenes.id', $almacen)->first();

            $this->tipo = $nn->tipo;
            if($this->tipo == 3){
                $this->state['cantidad'] = 1;
            }else{
                $this->state['cantidad'] = 0;
            }
            $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
        }
    }
    public function rtabl($tp = 1){
        $this->dispatch('rtablaItems', $this->tipo, $this->state['almacen_id'], $this->search, $this->tp, $this->tp_mov, $this->ubicacion);  
    }
    public function guardar($tp) {
        $this->state['created_by'] = auth()->user()->id;
        $this->state['created_at'] = date('Y-m-d H:i');
        
        if(count($this->itemSel)>0){
            $data = [];
            $error = '';
            foreach ($this->itemSel as $val) {
                if(!$val['cant']){
                    $error.='Debes agregar una cantidad.<br>';
                }
                if(!$val['partida']){
                    $error.='Debes seleccionar una Partida de Control.<br>';
                }
                $vl = $this->calcValores($val['cant'], $val['com_sin_igv']);
                $data[] = [
                    'item_id' => $val['id'],
                    'porcentaje_igv' =>$this->igv,
                    'valor_igv' =>($vl['com_par_con_igv']-$vl['com_par_sin_igv']),
                    'partida_id' => $val['partida'],
                    'precio' => $val['com_sin_igv'],
                    'cantidad' => $val['cant'],
                    'almacen_tipo' => $this->tipo,
                    'almacen_id' => $this->state['almacen_id'], 
                    'com_sin_igv' => $vl['com_sin_igv'], 
                    'com_con_igv' => $vl['com_con_igv'], 
                    'com_par_con_igv' => $vl['com_par_con_igv'], 
                    'com_par_sin_igv' => $vl['com_par_sin_igv'], 
                    'tipo_movimiento' =>$this->tp_mov,
                    'created_by' =>auth()->user()->id, 
                    'created_at' => date('Y-m-d H:i:s')];
            }
            if ($error !=''){
                $this->alert('error', 'Se encontraron los siguientes errores: <br>'.$error);
            }else{
                try{
                    DB::beginTransaction();
                        $this->state['almacen_tipo'] = $this->tipo;
                        if($this->tp == 1){
                            foreach ($data as $dt) {
                                $sav = PedidoDetalleTemp::updateorcreate(
                                    [
                                        'item_id' => $dt['item_id']
                                    ]
                                    , $dt
                                );
                            }
                        }elseif($this->tp == 3){
                            $sav = IngresoDetalleTemp::insert($data);
                        }else{
                            $sav = CompraDetalleTemp::insert($data);
                        }
                    DB::commit();
                    $this->alert('success', 'Se agregaron agregado correctamente.');
                    $this->emit('rTab');
                    if($tp){
                        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
                    }else{
                        
                    }
                }catch(\Exception $e){dd($e);
                    DB::rollback();
                    $this->alert('error', 'Ocurrio un error inesperado.');
                }
            }
        }else{
            $this->alert('error', 'Debes agregar almenos 01 Item.');
        }
    }
    public function calcValores($cant, $precio){
        $igv = '1.'.$this->igv;
        $data =[];
        if(!$precio){$precio = 0;}
        if($precio){
            $com_con_igv = number_format($precio*$igv, 4);
            $com_par_sin_igv = number_format($precio*$cant, 4);
            $com_par_con_igv = number_format($com_con_igv*$cant, 4);
            $data['com_sin_igv'] = str_replace(',', '', $precio);
            $data['com_con_igv'] = str_replace(',', '', $com_con_igv);
            $data['com_par_con_igv'] = str_replace(',', '', $com_par_con_igv);
            $data['com_par_sin_igv'] = str_replace(',', '', $com_par_sin_igv);
        }else{
            $data['com_sin_igv'] = 0;
            $data['com_con_igv'] = 0;
            $data['com_par_con_igv'] = 0;
            $data['com_par_sin_igv'] = 0;
        }
        return $data;
    }
    public function render(){
        $this->titulos = PartidaTitulo::join('adm_locales as l', 'l.id', 'op_partidas_titulos.proyecto_id')
            ->join('log_almacenes as a', 'a.local_id', 'l.id')
            ->select(DB::raw("CONCAT(op_partidas_titulos.codigo, ' - ', op_partidas_titulos.nombre) as nom"), 'op_partidas_titulos.id')
            ->where('a.id', $this->almacen)->get();
        $this->partidas = PartidaControl::select(DB::raw("CONCAT(codigo, ' - ', nombre) as nom"), 'id', 'partidaTitulo_id')->whereIn('partidaTitulo_id', $ids)->get();
        return view('livewire.financiero-contable.compras.pedidos.components.listar-items');
    }
}
