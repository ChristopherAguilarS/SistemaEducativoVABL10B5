<?php

namespace App\Http\Livewire\Rrhh\Configuracion\CursoEmpresa;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
use App\Models\Administracion\EmpresaCurso;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $estado = 2, $perPage = 20;
    public function renderizar(){
        $this->render();
    }
    public function rtabla($estado){
        $this->estado = $estado;
    }
    public function render(){
        $data = EmpresaCurso::query();       
        if ($this->estado != 2) {
            $data = $data->where('estado', $this->estado);
        }
       return view('livewire.rrhh.configuracion.curso-empresa.table',['posts' => $data->orderby('nombre', 'asc')->paginate($this->perPage)]);
    }
}
