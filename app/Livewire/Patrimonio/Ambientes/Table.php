<?php

namespace App\Livewire\Patrimonio\Ambientes;
use App\Models\Patrimonio\Ambiente;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $esado = 0, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($grupo, $clase){
        $this->grupo = $grupo;
        $this->clase = $clase;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function render(){
        $data = Ambiente::leftjoin('log_catalogo_tipos_ambientes as ct', 'ct.id', 'log_ambientes.catalogo_tipo_ambiente_id')
            ->leftjoin('log_catalogo_ubicaciones as u', 'u.id', 'log_ambientes.catalogo_ubicacion_id')
            ->select('log_ambientes.id', 'log_ambientes.nombre', 'log_ambientes.descripcion', 'ct.descripcion as tipo', 'u.descripcion as ubicacion', 'log_ambientes.estado')
            ->paginate($this->perPage);
        return view('livewire.patrimonio.ambientes.table',['posts' => $data]);
    }
}