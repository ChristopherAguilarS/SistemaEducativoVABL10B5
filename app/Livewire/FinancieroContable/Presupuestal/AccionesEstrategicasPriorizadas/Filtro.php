<?php

namespace App\Livewire\FinancieroContable\Presupuestal\AccionesEstrategicasPriorizadas;

use App\Models\ObjetivoEstrategico;
use Livewire\Component;

class Filtro extends Component
{
    public $objetivos_estrategicos;
    public $objetivo_estrategico_id;
    public $busqueda;
    
    public function mount(){
        $this->objetivos_estrategicos = ObjetivoEstrategico::where('estado',1)->get();
    }

    public function updatedObjetivoEstrategicoId(){
        $this->dispatch('enviarObjetivoEstrategicoId',$this->objetivo_estrategico_id);
    }

    public function updatedBusqueda(){
        $this->dispatch('enviarBusqueda',$this->busqueda);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.acciones-estrategicas-priorizadas.filtro');
    }
}
