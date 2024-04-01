<?php

namespace App\Livewire\Rrhh\Horarios\Turnos;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RecursosHumanos\Turno;
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
        $data = Turno::where('estado', $this->estado);
        return view('livewire.rrhh.horarios.turnos.table',['posts' => $data->orderby('id', 'desc')->paginate($this->perPage)]);
    }
}