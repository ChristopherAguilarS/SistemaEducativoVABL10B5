<?php

namespace App\Http\Livewire\Rrhh\Asistencias\Feriados;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Rrhh\Feriado;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $estado = 2, $perPage = 20;
    public function renderizar(){
        $this->render();
    }
    public function render(){
        $data = Feriado::query();
       return view('livewire.rrhh.asistencias.feriados.table',['posts' => $data->orderby('fecha', 'desc')->paginate($this->perPage)]);
    }
}
