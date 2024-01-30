<?php

namespace App\Livewire\Configuracion\Financiero\TipoTransaccion;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.configuracion.financiero.tipo-transaccion.filtro');
    }
}
