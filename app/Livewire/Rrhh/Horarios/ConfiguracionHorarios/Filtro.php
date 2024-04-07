<?php
namespace App\Livewire\Rrhh\Horarios\ConfiguracionHorarios;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.rrhh.horarios.configuracion-horarios.filtro');
    }
}