<?php

namespace App\Livewire\FinancieroContable\Contabilidad\NotasContables;

use Livewire\Component;

class Filtro extends Component
{
    public $fecha_inicio;
    public $fecha_fin;

    public function updatedFechaInicio(){
        $this->dispatch('actualizarFechas',$this->fecha_inicio,$this->fecha_fin);
    }

    public function updatedFechaFin(){
        $this->dispatch('actualizarFechas',$this->fecha_inicio,$this->fecha_fin);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.contabilidad.notas-contables.filtro');
    }
}
