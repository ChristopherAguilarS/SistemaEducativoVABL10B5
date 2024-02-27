<?php

namespace App\Livewire\FinancieroContable\Presupuestal\PlanAnualTrabajo;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.plan-anual-trabajo.filtro');
    }
}
