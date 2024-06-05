<?php

namespace App\Livewire\Patrimonio\Configuracion\CatalogoTipoPiso;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patrimonio\CatalogoTipoPiso;
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
        $data = CatalogoTipoPiso::orderby('descripcion', 'asc')->get();
        return view('livewire.patrimonio.configuracion.catalogo-tipo-piso.table',['posts' => $data]);
    }
}