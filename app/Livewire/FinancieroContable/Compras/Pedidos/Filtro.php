<?php
namespace App\Livewire\FinancieroContable\Compras\Pedidos;
use Livewire\Component;
use App\Models\FinancieroContable\Almacen;
class Filtro extends Component{
    public $txInicio, $txFin, $almacen_id = 0, $almacenes;
    public function mount(){
        $this->txInicio = date('Y-m-d');
        $this->txFin = date('Y-m-d');
    }
    public function cEstado(){
        $this->dispatch('rTablaEstado', $this->estado, $this->mes);
    }
    public function render(){
        $this->almacenes = Almacen::where('estado', 1)->get();
        return view('livewire.financiero-contable.compras.pedidos.filtro');
    }
}