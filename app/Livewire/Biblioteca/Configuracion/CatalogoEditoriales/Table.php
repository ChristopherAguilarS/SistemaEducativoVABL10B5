<?php

namespace App\Livewire\Biblioteca\Configuracion\CatalogoEditoriales;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Biblioteca\CatalogoEditorial;
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
        $data = CatalogoEditorial::orderby('descripcion', 'asc')->get();
        return view('livewire.biblioteca.configuracion.catalogo-editoriales.table',['posts' => $data]);
    }
}