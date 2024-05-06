<?php

namespace App\Livewire\Biblioteca\Adquisiciones;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Biblioteca\Libro;
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
        $data = Libro::with(['autor', 'editorial', 'ingreso'])->orderby('nombre', 'asc')->get();
        return view('livewire.biblioteca.adquisiciones.table',['posts' => $data]);
    }
}