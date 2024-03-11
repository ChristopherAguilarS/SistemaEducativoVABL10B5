<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Fotochecks;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Rrhh\TipoTrabajador;
class Filtros extends Component {
    use LivewireAlert;
    public $selectEstado = 2, $tipo, $categoria, $tipos;
    public function buscar() {
        $this->emit('rtabla', $this->selectEstado);
    }

    public function mount(){
        $this->tipos = TipoTrabajador::get();
    }
    public function exportar(){
        $this->emit('exportar', $this->selectLugar, $this->selectTipo, $this->selectMes, $this->selectAnio, $this->selectEstado);
    }
    public function render() {
        return view('livewire.rrhh.configuracion.fotochecks.filtros');
    }
}