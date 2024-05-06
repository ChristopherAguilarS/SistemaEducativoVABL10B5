<?php

namespace App\Livewire\Patrimonio\Configuracion\CatalogoTiposAmbientes;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patrimonio\CatalogoTipoAmbiente;
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
        $data = CatalogoTipoAmbiente::orderby('descripcion', 'asc')->get();
        return view('livewire.patrimonio.configuracion.catalogo-tipos-ambientes.table',['posts' => $data]);
    }
}