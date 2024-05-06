<?php
namespace App\Livewire\Expedientes\Expedientes;
use Livewire\Component;
class Filtro extends Component{
    public $desde, $hasta, $expediente;
    public function buscar(){
        $this->dispatch('rTabla', $this->expediente, $this->desde, $this->hasta);
    }
    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
    }
    public function render(){
        return view('livewire.expedientes.expedientes.filtro');
    }
}