<?php

namespace App\Http\Livewire\Rrhh\Reportes\LiquidacionesObservadas;
use App\Models\Rrhh\HojaAprobacion;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\Rrhh\Trabajadores\LiquidacionesObservadasExport;
class Filtros extends Component
{
    use LivewireAlert;
    protected $listeners = ['cancelar', 'cancelado'];
    public $selectEstado = 2, $selectLugar = 0, $locales, $selectTipo, $roles, $selectAp, $idR;

    public function buscar(){
        $this->emit('rtabla', $this->selectLugar,$this->selectTipo, $this->selectAp);
    }
    public function descargar(){
        return Excel::download(new LiquidacionesObservadasExport($this->selectLugar,$this->selectTipo, $this->selectAp), 'Liquidaciones '.date('d-m-Y').'.xlsx');
    }
    public function mount(){
        $this->roles = HojaAprobacion::join('rrhh_hoja_aprobaciones_tipo as ha', 'ha.hojaAprobacion_id', 'rrhh_hoja_aprobaciones.id')->select('rrhh_hoja_aprobaciones.id', 'rrhh_hoja_aprobaciones.nombre', 'abreviatura')->distinct()->orderby('nombre', 'asc')->get();
    }
    public function render(){
        return view('livewire.rrhh.reportes.liquidaciones-observadas.filtros');
    }
}
