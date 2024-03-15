<?php

namespace App\Livewire\FinancieroContable\Compras\Pedidos;
use App\Models\FinancieroContable\Pedido;
use App\Models\SubGenericaNivel2;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $almacen, $search = null, $busq,$buscarPor = 2, $cbAnio, $cbMes, $cbDia, $txInicio, $txFin, $cbEstado = 0, $cbRevision = 0, $cbTipo = 0, $perPage = 20;
    public function mount(){
        $this->subgenericas = SubGenericaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }
    #[On('renderizarTbl')]
    public function renderizarTbl(){
        $this->render();
    }
    #[On('rTabla')]
    public function rtabla($almacen, $buscarPor, $cbAnio, $cbMes, $cbDia, $txInicio, $txFin, $cbEstado, $cbRevision, $cbTipo){
        $this->almacen = $almacen;
        $this->buscarPor = $buscarPor;
        $this->cbAnio = $cbAnio;
        $this->cbMes = $cbMes;
        $this->cbDia = $cbDia;
        $this->txInicio = $txInicio;
        $this->txFin = $txFin;
        $this->cbEstado = $cbEstado;
        $this->cbRevision = $cbRevision;
        $this->cbTipo = $cbTipo;
    }
   
    public function render(){
        $data = Pedido::with('solicitante');
        if($this->cbRevision == 1){
            $data = $data->whereRaw('(SELECT COUNT(*) FROM log_pedidos_detalles pd WHERE pd.pedido_id = log_pedidos.id and estado = 1) = 0');
        }elseif($this->cbRevision == 2){
            $data = $data->whereRaw('(SELECT COUNT(*) FROM log_pedidos_detalles pd WHERE pd.pedido_id = log_pedidos.id and estado = 1) > 0');
        }
        $data->whereBetween('fecha', [$this->txInicio, $this->txFin]);

        if($this->almacen){
            $data = $data->where('almacen_id', $this->almacen);
        }
        if($this->search){
            $data = $data->whereRaw("log_pedidos.id like '%".intval($this->search)."%'");
        }
        return view('livewire.financiero-contable.compras.pedidos.table',['posts' => $data->orderby('id', 'desc')->paginate($this->perPage)]);
    }
}