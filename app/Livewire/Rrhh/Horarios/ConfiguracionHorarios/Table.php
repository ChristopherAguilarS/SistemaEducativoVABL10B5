<?php

namespace App\Livewire\Rrhh\Horarios\ConfiguracionHorarios;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RecursosHumanos\ProgramacionAutomatica;
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
        $data = ProgramacionAutomatica::query();
        if ($this->estado != 2) {
            $data = $data->where('estado', $this->estado);
        }
        return view('livewire.rrhh.horarios.configuracion-horarios.table',['posts' => $data->orderby('id', 'desc')->paginate($this->perPage)]);
    }
}