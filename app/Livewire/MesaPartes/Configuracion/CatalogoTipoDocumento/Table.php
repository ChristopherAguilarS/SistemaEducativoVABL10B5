<?php

namespace App\Livewire\MesaPartes\Configuracion\CatalogoTipoDocumento;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MesaPartes\CatalogoTipoDocumento;
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
        $data = CatalogoTipoDocumento::orderby('descripcion', 'asc')->get();
        return view('livewire.mesa-partes.configuracion.catalogo-tipo-documento.table',['posts' => $data]);
    }
}