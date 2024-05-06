<?php

namespace App\Livewire\MesaPartes\BusquedaDocumento;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MesaPartes\Expediente;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $exp, $desde, $hasta, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($exp, $desde, $hasta){
        $this->exp = $exp;
        $this->desde = $desde;
        $this->hasta = $hasta;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function mount(){
        $this->desde = date('Y-m-d');
        $this->hasta = date('Y-m-d');
    }
    public function render(){
        $data = Expediente::query();
        if($this->desde && $this->hasta){
            $data = $data->whereBetween(DB::raw('DATE(created_at)'), [$this->desde, $this->hasta]);
        }
        if($this->exp){
            $data = $data->where('id', $this->exp);
        }
        return view('livewire.mesa-partes.busqueda-documento.table',['posts' => $data->orderby('id', 'asc')->get()]);
    }
}