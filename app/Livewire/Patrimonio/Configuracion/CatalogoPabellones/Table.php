<?php

namespace App\Livewire\Patrimonio\Configuracion\CatalogoPabellones;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patrimonio\CatalogoPabellon;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estado = 0, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($estado){
        $this->estado = $estado;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function render(){
        $data = CatalogoPabellon::query();
        if($this->estado == 1){
            $data = $data->where('estado', 1);
        }elseif($this->estado == 2){
            $data = $data->where('estado', 0);
        }
        $data = $data->orderby('descripcion', 'asc')->get();
        return view('livewire.patrimonio.configuracion.catalogo-pabellones.table',['posts' => $data]);
    }
}