<?php
namespace App\Livewire\Biblioteca\Inicio\Components;
use App\Models\Biblioteca\CatalogoCategoria;
use App\Models\Biblioteca\CatalogoMateria;
use Livewire\Component;
class Contactanos extends Component{
    public $categorias, $materias, $search, $catalogo, $materia;
    public function mount(){
        $this->categorias = CatalogoCategoria::where('estado', 1)->get();
        $this->materias = CatalogoMateria::where('estado', 1)->get();
    }

    public function render(){
        return view('livewire.biblioteca.inicio.components.contactanos');
    }
}