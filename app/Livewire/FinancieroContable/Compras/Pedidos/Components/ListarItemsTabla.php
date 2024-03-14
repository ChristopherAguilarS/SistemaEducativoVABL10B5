<?php

namespace App\Livewire\FinancieroContable\Compras\Pedidos\Components;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Http\Controllers\FinancieroContable\FuncionesCtrl;
use DB;
class ListarItemsTabla extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 6, $tipo_almacen = 1, $categoria = 0, $almacen, $search, $pedido_compra, $tSel, $ubi = 0;
    #[On('rtablaItems')]
    public function rtablaItems($tipo_almacen, $almacen_id, $se, $tSel, $ubi = 0){
        $this->tipo_almacen = $tipo_almacen;
        $this->almacen = $almacen_id;
        $this->search = $se;
        $this->tSel = $tSel;
        $this->ubi = $ubi;
    }
    public function render(){
        $obj = new FuncionesCtrl();
        if($this->tipo_almacen == 1 || $this->tipo_almacen == 2){
            if($this->tSel == 1){
                $data = $obj->InsumoAll($this->tipo_almacen, $this->almacen, $this->search);
 
            }else{
                $data = $obj->InsumoStock($this->tipo_almacen, $this->almacen, $this->search);
            }
        }elseif($this->tipo_almacen == 3){
            if($this->tSel == 1){
                $data = $obj->EquipoAll($this->tipo_almacen, $this->almacen, $this->search);
            }else{
                $data = $obj->EquipoStock($this->tipo_almacen, $this->almacen, $this->search);
            }
        }
        return view('livewire.financiero-contable.compras.pedidos.components.listar-items-tabla',['posts' => $data]);
    }
}
