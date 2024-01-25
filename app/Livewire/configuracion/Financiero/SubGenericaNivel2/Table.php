<?php

namespace App\Livewire\Configuracion\Financiero\SubGenericaNivel2;

use App\Models\SubGenericaNivel2;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        $subgenericas = SubGenericaNivel2::paginate(10);
        return view('livewire.configuracion.financiero.sub-generica-nivel-2.table',['subgenericas'=>$subgenericas]);
    }
}
