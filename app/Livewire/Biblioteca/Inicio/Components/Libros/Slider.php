<?php
namespace App\Livewire\Biblioteca\Inicio\Components\Libros;
use App\Models\Biblioteca\CatalogoCategoria;
use App\Models\Biblioteca\CatalogoMateria;
use Livewire\Component;
class Slider extends Component{
    public $categorias, $materias, $search, $catalogo, $materia;
    public function mount(){
        $this->categorias = CatalogoCategoria::where('estado', 1)->get();
        $this->materias = CatalogoMateria::where('estado', 1)->get();
    }

    public function render(){
        return view('livewire.biblioteca.inicio.components.libros.slider');
    }
}