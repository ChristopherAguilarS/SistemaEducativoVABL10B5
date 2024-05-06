<?php

namespace App\Livewire\Biblioteca\Configuracion\CatalogoIdiomas;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Biblioteca\CatalogoIdioma;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estado = 1, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($estado){
        $this->estado = $estado;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function render(){
        $data = CatalogoIdioma::orderby('descripcion', 'asc')->get();
        return view('livewire.biblioteca.configuracion.catalogo-idiomas.table',['posts' => $data]);
    }
}