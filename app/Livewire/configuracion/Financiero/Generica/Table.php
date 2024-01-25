<?php

namespace App\Livewire\Configuracion\Financiero\Generica;

use App\Models\Generica;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        $genericas = Generica::paginate(10);
        return view('livewire.configuracion.financiero.generica.table',['genericas'=>$genericas]);
    }
}
