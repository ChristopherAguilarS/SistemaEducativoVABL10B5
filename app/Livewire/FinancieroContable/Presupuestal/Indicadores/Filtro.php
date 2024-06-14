<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Indicadores;

use App\Models\ActividadOperativa;
use App\Models\MovimientoCajaChica;
use Livewire\Attributes\On;
use Livewire\Component;

class Filtro extends Component
{
    public $fecha_inicio;
    public $fecha_fin;
    public $actividades_operativas;
    public $actividad_operativa_id;
    public $busqueda;

    public function mount(){
        $this->actividades_operativas = ActividadOperativa::where('estado', 1)->get();
    }

    public function updatedActividadOperativaId(){
        $this->dispatch('enviarActividadOperativaId',$this->actividad_operativa_id);
    }

    public function updatedBusqueda(){
        $this->dispatch('enviarBusqueda',$this->busqueda);
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
        return view('livewire.financiero-contable.presupuestal.indicadores.filtro');
    }
}
