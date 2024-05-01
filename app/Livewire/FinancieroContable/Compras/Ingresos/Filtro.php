<?php
namespace App\Livewire\FinancieroContable\Compras\Ingresos;
use Livewire\Component;
use App\Models\FinancieroContable\Almacen;
use Livewire\Attributes\On;
class Filtro extends Component{
    public $buscarPor = 2, $tipo, $cbAnio, $cbMes, $cbDia, $txInicio, $txFin, $cbEstado = 0, $cbTipo = 0, $cbComprobante = 0, $almacen, $almacenes;
    public function buscar(){
        $this->emit('rtabla', $this->almacen, $this->buscarPor, $this->cbAnio, $this->cbMes, $this->cbDia, $this->txInicio, $this->txFin, $this->cbEstado, $this->cbTipo, $this->cbComprobante);
    }
    public function descargar(){
        return Excel::download(new EquiposExport($this->selectAlmacen, $this->selectEstado, $this->categoria), 'Equipos '.date('d-m-Y').'.xlsx');
    }
    #[On('reIngresos')]
    public function render2($id, $tipo){
        $this->tipo = $tipo;
        $this->almacen = $id;
        $this->dispatch('rtabla', $this->almacen, $this->buscarPor, $this->cbAnio, $this->cbMes, $this->cbDia, $this->txInicio, $this->txFin, $this->cbEstado, $this->cbTipo, $this->cbComprobante);
    }
    public function mount(){
        $this->cbAnio = date('Y');
        $this->cbMes = date('n');
        $this->cbDia = date('j');
        $this->txInicio = date('Y-m-01');
        $this->txFin = date('Y-m-d');
    }
    public function render(){
        $this->almacenes = Almacen::where('estado', 1)->get();
        return view('livewire.financiero-contable.compras.ingresos.filtro');
    }
}