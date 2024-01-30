<?php

namespace App\Livewire\Configuracion\Financiero\SubGenericaNivel2;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }
    
    public function render()
    {
        return view('livewire.configuracion.financiero.sub-generica-nivel-2.filtro');
    }
}