<?php

namespace App\Http\Livewire\Rrhh\Asistencias\PermisosLicencias;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Controllers\Controller;
class Filtros extends Component
{
    use LivewireAlert;
    protected $listeners = ['eliminar', 'borrar'];
    public $selectEstado = 1, $selectMes, $selectLugar, $selectAnio, $locales, $selectTipo=0;

    public function buscar()
    {
        $this->emit('rtabla', $this->selectLugar, $this->selectMes, $this->selectAnio,$this->selectEstado,$this->selectTipo);
    }
    public function mount(){
        $this->selectAnio = date('Y');
        $this->selectMes = date('m');
        if(auth()->user()->ubicacion){
            $this->selectLugar = auth()->user()->ubicacion;
        }
    }
    public function render() {
        $obj = new Controller();
        $this->locales=$obj->verLocalesProyectos(2);
        return view('livewire.rrhh.asistencias.permisos-licencias.filtros');
    }
}
