<?php
namespace App\Livewire\Patrimonio\Prestamos;
use Livewire\Component;

class Filtro extends Component{
    public $estado;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function mount(){
        
    }
    public function render(){
        return view('livewire.patrimonio.prestamos.filtro');
    }
}