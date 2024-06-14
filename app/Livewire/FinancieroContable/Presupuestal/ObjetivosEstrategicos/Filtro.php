<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ObjetivosEstrategicos;

use App\Models\PlanAnualTrabajo;
use Livewire\Component;

class Filtro extends Component
{
    public $plan_anuales;
    public $plan_id;
    public $busqueda;
    
    public function mount(){
        $this->plan_anuales = PlanAnualTrabajo::where('estado',1)->get();
    }

    public function updatedPlanId(){
        $this->dispatch('enviarPlanId',$this->plan_id);
    }

    public function updatedBusqueda(){
        $this->dispatch('enviarBusqueda',$this->busqueda);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.filtro');
    }
}
