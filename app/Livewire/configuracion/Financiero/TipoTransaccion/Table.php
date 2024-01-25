<?php

namespace App\Livewire\Configuracion\Contable\CajaBancos;

use App\Models\MovimientoCajaBanco;
use App\Models\TipoTransaccion;
use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        $movimientos = MovimientoCajaBanco::paginate(10);
        return view('livewire.contable.cajba-bancos.table',['movimientos'=>$movimientos]);
    }
}
