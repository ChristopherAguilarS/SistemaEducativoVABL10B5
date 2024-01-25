<?php

namespace App\Livewire\Configuracion\Contable\Cuentas;

use App\Models\Cuenta;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $cuentas = Cuenta::paginate(10);
        return view('livewire.configuracion.contable.cuentas.table',['cuentas'=>$cuentas]);
    }
}
