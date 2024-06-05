<?php
namespace App\Livewire\Biblioteca\ReservasEntregas;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 9, $search;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado, $this->search);
    }
    public function render(){
        return view('livewire.biblioteca.reservas-entregas.filtro');
    }
}