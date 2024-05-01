<?php

namespace App\Livewire\FinancieroContable\Compras\Compras;
use App\Models\FinancieroContable\Compra;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $almacen, $search, $busq, $perPage = 20, $cbRevision,$txInicio, $txFin, $estado, $cbIngreso;
    #[On('renderizar')]
    public function renderizar(){
        $this->render();
    }
    public function buscar(){
        $this->search = $this->busq;
    }
    public function mount(){
        $this->txInicio = date('Y-m-d');
        $this->txFin = date('Y-m-d');
    }
    #[On('rtabla')]
    public function rtabla($tipo, $almacen_id, $cbRevision, $estado, $txInicio, $txFin){
        $this->almacen = $almacen_id;
        $this->tipo = $tipo;
        $this->cbRevision = $cbRevision;
        $this->estado = $estado;
        $this->txInicio = $txInicio;
        $this->txFin = $txFin;
    }
    public function render(){
        $data = Compra::leftjoin('log_catalogo_proveedores as cp', 'cp.id', 'log_compras.proveedor_id')
            ->leftjoin('log_catalogo_monedas as m', 'log_compras.moneda_id', 'm.id')
            ->select('log_compras.id', 'log_compras.correlativo','cp.nombre as proveedor', 'log_compras.almacen_id', 'log_compras.fecha', 'log_compras.estado', 'ingreso_id as ingreso', 'created_ingreso_at as fech_ingreso', 'log_compras.total', 'simbolo')
             ->where('log_compras.ingreso_tipo', 2);

        $data = $data->whereBetween('log_compras.fecha', [$this->txInicio, $this->txFin]);
//dd($data->get());
        if($this->almacen){
            $data = $data->where('log_compras.almacen_id', $this->almacen);
        }elseif($this->estado == 2){

        }
    
        if($this->search){
            $data = $data->whereRaw("(log_compras.correlativo like '%".$this->search."%' or cp.nombre like '%".$this->search."%' or cp.id like '%".$this->search."%')");
        }
        
       return view('livewire.financiero-contable.compras.compras.table',['posts' => $data->orderby('id', 'desc')->paginate($this->perPage)]);
    }
}