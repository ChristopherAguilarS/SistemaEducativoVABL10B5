<?php

namespace App\Livewire\Configuracion\Financiero\EspecificaNivel2;

use App\Models\EspecificaNivel2;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        $especificas = EspecificaNivel2::paginate(10);
        return view('livewire.configuracion.financiero.especifica-nivel-2.table',['especificas'=>$especificas]);
    }
}
