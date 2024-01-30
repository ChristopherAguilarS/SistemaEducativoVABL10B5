<?php

namespace App\Livewire\Configuracion\Financiero\Generica;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }
    
    public function render()
    {
        return view('livewire.configuracion.financiero.generica.filtro');
    }
}
