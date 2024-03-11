<?php

namespace App\Http\Livewire\Rrhh\Horarios\ConfiguracionHorario;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Rrhh\ProgramacionAutomatica;
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
        $data = ProgramacionAutomatica::query();
        if ($this->estado != 2) {
            $data = $data->where('estado', $this->estado);
        }
       return view('livewire.rrhh.horarios.configuracion-horario.table',['posts' => $data->orderby('nombre', 'asc')->paginate($this->perPage)]);
    }
}
