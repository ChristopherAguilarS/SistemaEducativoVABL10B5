<?php

namespace App\Http\Livewire\Rrhh\Configuracion\AprobacionTipo;
use App\Models\Rrhh\TipoTrabajador;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Filtros extends Component {
    use LivewireAlert;
    public $tipo, $tipos;
    public function buscar() {
        $this->emit('rtabla', $this->tipo);
    }
    public function mount(){
        $this->tipos = TipoTrabajador::get();
    }
    public function exportar(){
        $this->emit('exportar', $this->selectLugar, $this->selectTipo, $this->selectMes, $this->selectAnio, $this->selectEstado);
    }
    public function render() {
        return view('livewire.rrhh.configuracion.aprobacion-tipo.filtros');
    }
}