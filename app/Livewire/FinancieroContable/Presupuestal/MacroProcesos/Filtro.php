<?php

namespace App\Livewire\FinancieroContable\Presupuestal\MacroProcesos;

use App\Models\TipoProceso;
use Livewire\Component;

class Filtro extends Component
{
    public $tipo_procesos = [];
    public $tipo_proceso_id;
    public $busqueda;
    
    public function mount(){
        $this->tipo_procesos = TipoProceso::where('estado',1)->get();
    }

    public function updatedTipoProcesoId(){
        $this->dispatch('enviarTipoProcesoId',$this->tipo_proceso_id);
    }

    public function updatedBusqueda(){
        $this->dispatch('enviarBusqueda',$this->busqueda);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.macro-procesos.filtro');
    }
}
