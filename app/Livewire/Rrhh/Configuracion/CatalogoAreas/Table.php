<?php

namespace App\Livewire\Rrhh\Configuracion\CatalogoAreas;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RecursosHumanos\CatalogoArea;
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
        $data = CatalogoArea::orderby('descripcion', 'asc')->get();
        return view('livewire.rrhh.configuracion.catalogo-areas.table',['posts' => $data]);
    }
}