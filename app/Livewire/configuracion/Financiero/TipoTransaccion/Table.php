<?php

namespace App\Livewire\Configuracion\Financiero\TipoTransaccion;

use App\Models\TipoTransaccion;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        $tipoTransacciones = TipoTransaccion::paginate(10);
        return view('livewire.configuracion.financiero.tipo-transaccion.table',['tipoTransacciones'=>$tipoTransacciones]);
    }
}
