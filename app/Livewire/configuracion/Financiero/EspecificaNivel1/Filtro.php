<?php

namespace App\Livewire\Configuracion\Financiero\EspecificaNivel1;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.configuracion.financiero.especifica-nivel-1.filtro');
    }
}
