<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\Indicadores;

use App\Models\MovimientoCajaChica;
use Livewire\Attributes\On;
use Livewire\Component;

class Filtro extends Component
{
    public $fecha_inicio;
    public $fecha_fin;
    public $apertura = false;
    public $cierre = false;

    public function mount(){
        $apertura = MovimientoCajaChica::where('estado', 1)->where('tipo',1)->first();
        if($apertura == null){
            $this->apertura = true;
        }
        else{
            $this->apertura = false;
        }
    }

    public function updatedFechaInicio(){
        $this->dispatch('actualizarFechas',$this->fecha_inicio,$this->fecha_fin);
    }

    public function updatedFechaFin(){
        $this->dispatch('actualizarFechas',$this->fecha_inicio,$this->fecha_fin);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function aperturaCC(){
        $this->dispatch('apertura');
    }

    public function cierreCC(){
        $this->dispatch('cierre');
    }

    #[On('actualizarCards')]
    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.indicadores.filtro');
    }
}
