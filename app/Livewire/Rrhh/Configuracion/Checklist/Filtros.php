<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Checklist;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Rrhh\HojaAprobacion;
class Filtros extends Component {
    use LivewireAlert;
    public $selectEstado = 2, $selectApro, $aprobaciones;
    public function buscar() {
        $this->emit('rtabla', $this->selectApro, $this->selectEstado);
    }
    public function mount(){
        $this->aprobaciones = HojaAprobacion::get();
    }
    public function exportar(){
        $this->emit('exportar', $this->selectLugar, $this->selectTipo, $this->selectMes, $this->selectAnio, $this->selectEstado);
    }
    public function render() {
        return view('livewire.rrhh.configuracion.checklist.filtros');
    }
}