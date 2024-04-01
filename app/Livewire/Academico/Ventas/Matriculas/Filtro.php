<?php
namespace App\Livewire\Academico\Ventas\Matriculas;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.academico.ventas.matriculas.filtro');
    }
}