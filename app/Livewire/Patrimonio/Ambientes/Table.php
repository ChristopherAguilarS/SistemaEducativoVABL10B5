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
    public $pabellon = 0, $estado = 0, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($estado, $pabellon){
        $this->estado = $estado;
        $this->pabellon = $pabellon;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function render(){
        $data = Ambiente::leftjoin('log_catalogo_tipos_ambientes as ct', 'ct.id', 'log_ambientes.catalogo_tipo_ambiente_id')
            ->leftjoin('log_catalogo_pabellones as u', 'u.id', 'log_ambientes.catalogo_pabellon_id')
            ->select('log_ambientes.id', 'log_ambientes.nombre', 'ct.descripcion as tipo', 'u.descripcion as ubicacion', 'log_ambientes.estado');
        if($this->estado == 1){
            $data = $data->where('log_ambientes.estado', 1);
        }elseif($this->estado == 2){
            $data = $data->where('log_ambientes.estado', 0);
        }
        if($this->pabellon){
            $data = $data->where('log_ambientes.catalogo_pabellon_id', $this->pabellon);
        }
        return view('livewire.patrimonio.ambientes.table',['posts' => $data->paginate($this->perPage)]);
    }
}