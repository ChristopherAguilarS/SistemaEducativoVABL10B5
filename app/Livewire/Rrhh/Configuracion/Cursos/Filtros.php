<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Cursos;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Filtros extends Component {
    use LivewireAlert;
    public $selectEstado = 2, $tipo, $categoria, $tipos;
    public function buscar() {
        $this->emit('rtabla', $this->selectEstado);
    }
    public function exportar(){
        $this->emit('exportar', $this->selectLugar, $this->selectTipo, $this->selectMes, $this->selectAnio, $this->selectEstado);
    }
    public function render() {
        return view('livewire.rrhh.configuracion.cursos.filtros');
    }
}