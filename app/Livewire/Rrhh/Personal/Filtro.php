<?php
namespace App\Livewire\Rrhh\Personal;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1, $mes = 0;
    public function mount(){
        $this->anio = date('Y');
    }
    public function cEstado(){
        $this->dispatch('rTablaEstado', $this->estado, $this->mes);
    }
    public function render(){
        return view('livewire.rrhh.personal.filtro');
    }
}