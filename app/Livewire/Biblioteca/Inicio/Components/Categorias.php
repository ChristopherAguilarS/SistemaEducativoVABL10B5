<?php
namespace App\Livewire\Biblioteca\Inicio\Components;
use App\Models\Biblioteca\CatalogoCategoria;
use App\Models\Biblioteca\Libro;
use App\Models\Biblioteca\CatalogoAutor;
use Livewire\Component;
class Categorias extends Component{
    public $categorias, $autores, $search, $catalogo, $materia, $libros;
    public function mount(){
        $this->categorias = CatalogoCategoria::where('estado', 1)->has('libros')->withCount('libros')->get();
        $this->autores = CatalogoAutor::where('estado', 1)->has('libros')->withCount('libros')->get();
    }

    public function render(){
        $this->libros = Libro::join('biblioteca_catalogo_autores as ca', 'ca.id', 'biblioteca_libros.catalogo_autor_id')
            ->select('biblioteca_libros.id', 'biblioteca_libros.nombre', 'biblioteca_libros.imagen', 'ca.descripcion as autor', 'valoracion')->inRandomOrder()->take(12)->get();
        return view('livewire.biblioteca.inicio.components.categorias');
    }
}