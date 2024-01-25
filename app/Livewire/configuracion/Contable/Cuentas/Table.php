<?php

namespace App\Livewire\Configuracion\Contable\Cuentas;

use App\Models\Cuenta;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        $cuentas = Cuenta::paginate(10);
        return view('livewire.configuracion.contable.cuentas.table',['cuentas'=>$cuentas]);
    }
}
