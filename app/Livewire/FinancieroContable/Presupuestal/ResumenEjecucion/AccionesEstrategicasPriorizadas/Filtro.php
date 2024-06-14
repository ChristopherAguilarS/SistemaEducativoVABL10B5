<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\AccionesEstrategicasPriorizadas;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.acciones-estrategicas-priorizadas.filtro');
    }
}
