<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Profesiones;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
use App\Models\Rrhh\Profesion;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $estado = 2, $perPage = 20, $nivel = 0;
    public function renderizar(){
        $this->render();
    }
    public function rtabla($estado, $nivel ){
        $this->estado = $estado;
        $this->nivel = $nivel;
    }
    public function render(){
        $data = Profesion::query();       
        if ($this->estado != 2) {
            $data = $data->where('estado', $this->estado);
        }
        if ($this->nivel) {
            $data = $data->where('nivel_id', $this->nivel);
        }
       return view('livewire.rrhh.configuracion.profesiones.table',['posts' => $data->orderby('nombre', 'asc')->paginate($this->perPage)]);
    }
}
