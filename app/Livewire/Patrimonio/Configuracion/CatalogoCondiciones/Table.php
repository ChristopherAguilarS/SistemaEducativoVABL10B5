<?php

namespace App\Livewire\Patrimonio\Configuracion\CatalogoCondiciones;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patrimonio\CatalogoCondicion;
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
        $data = CatalogoCondicion::orderby('descripcion', 'asc')->get();
        return view('livewire.patrimonio.configuracion.catalogo-condiciones.table',['posts' => $data]);
    }
}