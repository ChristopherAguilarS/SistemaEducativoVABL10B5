<?php

namespace App\Livewire\FinancieroContable\Presupuestal\TipoProcesos;

use App\Models\PlanAnualTrabajo;
use Livewire\Component;

class Filtro extends Component
{
    public $busqueda;
    
    public function mount(){
        
    }

    public function updatedBusqueda(){
        $this->dispatch('enviarBusqueda',$this->busqueda);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.tipo-procesos.filtro');
    }
}
