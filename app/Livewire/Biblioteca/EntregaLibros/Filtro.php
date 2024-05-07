<?php
namespace App\Livewire\Biblioteca\EntregaLibros;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.biblioteca.entrega-libros.filtro');
    }
}