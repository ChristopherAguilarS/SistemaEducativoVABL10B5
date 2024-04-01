<?php
namespace App\Livewire\Rrhh\Horarios\Turnos;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.rrhh.horarios.turnos.filtro');
    }
}