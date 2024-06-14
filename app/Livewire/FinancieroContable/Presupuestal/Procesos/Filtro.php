<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Procesos;

use App\Models\MacroProceso;
use Livewire\Component;

class Filtro extends Component
{
    public $macro_procesos;
    public $macro_proceso_id;
    public $busqueda;
    
    public function mount(){
        $this->macro_procesos = MacroProceso::where('estado',1)->get();
    }

    public function updatedMacroProcesoId(){
        $this->dispatch('enviarMacroProcesoId',$this->macro_proceso_id);
    }

    public function updatedBusqueda(){
        $this->dispatch('enviarBusqueda',$this->busqueda);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.procesos.filtro');
    }
}
