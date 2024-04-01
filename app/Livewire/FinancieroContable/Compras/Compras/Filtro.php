<?php
namespace App\Livewire\FinancieroContable\Compras\Compras;
use Livewire\Component;
use App\Models\FinancieroContable\Almacen;
class Filtro extends Component{
    public $almacen_id = 0, $almacenes, $buscarPor, $cbAnio, $cbMes, $cbDia, $txInicio, $txFin, $cbRevision, $cbTipo, $estado;
    public function mount(){
        $this->txInicio = date('Y-m-d');
        $this->txFin = date('Y-m-d');
    }
    public function buscar(){
        $this->dispatch('rTabla', $this->almacen_id, $this->buscarPor, $this->cbAnio, $this->cbMes, $this->cbDia, $this->txInicio, $this->txFin, $this->cbRevision, $this->cbTipo);
    }
    public function cEstado(){
        $this->dispatch('rTablaEstado', $this->estado, $this->mes);
    }
    public function render(){
        $this->almacenes = Almacen::where('estado', 1)->get();
        return view('livewire.financiero-contable.compras.compras.filtro');
    }
}