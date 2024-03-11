<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Cargos;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
use App\Models\Rrhh\Cargo;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $tipo = 0, $estado = 2, $perPage = 20, $categoria;
    public function renderizar(){
        $this->render();
    }
    public function rtabla($tipo, $categoria, $estado){
        $this->tipo = $tipo;
        $this->categoria = $categoria;
        $this->estado = $estado;
    }
    public function render(){
        
        $data = Cargo::leftjoin('rrhh_catalogo_categoria as cc', 'cc.id', 'rrhh_catalogo_cargos.categoria')
            ->join('rrhh_catalogo_tipo as ct', 'ct.id', 'rrhh_catalogo_cargos.tipo')
            ->select('rrhh_catalogo_cargos.nombre as cargo', 'cc.nombre as categoria', 'ct.nombre as tipo', 'rrhh_catalogo_cargos.estado', 'color', 'rrhh_catalogo_cargos.id');

        if($this->tipo == 3){
            $data = $data->where('tipo', 3);
            if($this->categoria){
                $data = $data->where('categoria', $this->categoria);
            }
            
        }else{
            if($this->tipo ){
                $data = $data->where('tipo', $this->tipo);
            }
        }
        
        if ($this->estado != 2) {
            $data = $data->where('estado', $this->estado);
        }
       return view('livewire.rrhh.configuracion.cargos.table',['posts' => $data->orderby('cargo', 'asc')->paginate($this->perPage)]);
    }
}
