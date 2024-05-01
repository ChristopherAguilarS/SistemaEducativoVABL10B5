<?php

namespace App\Livewire\FinancieroContable\Compras\Ingresos;
use App\Models\FinancieroContable\Ingreso;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $almacen, $search = null, $busq, $busqueda, $buscarPor = 2, $cbAnio, $cbMes, $cbDia, $txInicio, $txFin, $cbEstado = 0, $cbTipo = 0, $cbComprobante = 0, $perPage = 20;
    
    public function buscar(){
        $this->search = $this->busq;
    }
    #[On('renderizar')]
    public function renderizar(){
        $this->render();
    }
    #[On('rtabla')]
    public function rtabla($almacen, $buscarPor, $cbAnio, $cbMes, $cbDia, $txInicio, $txFin, $cbEstado, $cbTipo, $cbComprobante){
        $this->almacen = $almacen;
        $this->buscarPor = $buscarPor;
        $this->cbAnio = $cbAnio;
        $this->cbMes = $cbMes;
        $this->cbDia = $cbDia;
        $this->txInicio = $txInicio;
        $this->txFin = $txFin;
        $this->cbEstado = $cbEstado;
        $this->cbTipo = $cbTipo;
        $this->cbComprobante = $cbComprobante;
    }
    public function mount(){
        $this->cbAnio = date('Y');
        $this->cbMes = date('n');
        $this->cbDia = date('j');
        $this->txInicio = date('Y-m-01');
        $this->txFin = date('Y-m-d');
    }
    public function render(){
        $data = Ingreso::with([
            'proveedor',
        ])
            ->leftJoin('log_compras as c', 'c.ingreso_id', '=', 'log_ingresos.id')
            ->leftJoin('log_pedidos_detalles as pd', 'pd.compra_id', '=', 'c.id')
            ->leftJoin('log_compras_comprobantes as cc', 'cc.id', '=', 'pd.comprobante_id')
            ->where('log_ingresos.almacen_id', $this->almacen)
            ->select([
                'log_ingresos.*',
                DB::raw("GROUP_CONCAT(DISTINCT CONCAT(cc.serie, '-', cc.correlativo)) AS comp"),
                DB::raw("GROUP_CONCAT(DISTINCT LPAD(c.correlativo, 6, '0')) AS ordenes")
            ])
            ->groupBy('log_ingresos.id'); // Agrupa por ID para evitar duplicados
            if($this->cbTipo){
                $data = $data->where('log_ingresos.tipo_movimiento', $this->cbTipo);
            }
        $this->busqueda = "(nombre like '%". $this->search ."%' or id like '%". $this->search ."%' or CONCAT(cc.serie, '-', cc.correlativo) like  '%" . $this->search . "%' or c.correlativo like  '%" . $this->search . "%')";
        
        if ($this->search) {
            $data->where(function ($query) {
                $query->whereHas('proveedor', function ($subquery) {
                    $subquery->whereRaw($this->busqueda);
                });            
            });
        }
        if($this->buscarPor == 1){
            $data = $data->whereDay('log_ingresos.created_at', $this->cbDia)
                ->whereMonth('log_ingresos.created_at', $this->cbMes)
                ->whereYear('log_ingresos.created_at', $this->cbAnio);
        }elseif($this->buscarPor == 2){
            $data = $data->whereMonth('log_ingresos.created_at', $this->cbMes);
            $data = $data->whereYear('log_ingresos.created_at', $this->cbAnio);
        }elseif($this->buscarPor == 3){
            $data = $data->whereYear('log_ingresos.created_at', $this->cbAnio);
        }elseif($this->buscarPor == 4){
            $fechaInicio = Carbon::parse($this->txInicio.' 00:00:00');
            $fechaFin = Carbon::parse($this->txFin.' 23:59:59');
            $data = $data->whereBetween('log_ingresos.created_at', [$fechaInicio, $fechaFin]);
        }
        if($this->cbEstado == 1){
            $data = $data->where('cc.catalogo_comprobantes_compra_id','!=', 99);
        }elseif($this->cbEstado == 2){
            $data = $data->where('cc.catalogo_comprobantes_compra_id', 99);
        }
        
        if($this->cbComprobante){
            $data = $data->whereMonth('tipo_comprobante', $this->cbComprobante);
        }
       return view('livewire.financiero-contable.compras.ingresos.table',['posts' => $data->orderby('id', 'desc')->paginate($this->perPage)]);
    }
}