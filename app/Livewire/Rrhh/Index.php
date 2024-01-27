<?php

namespace App\Livewire\Rrhh;

use App\Models\Cuenta;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $cuentas = Cuenta::paginate(10);
        return view('livewire.rrhh.index',['cuentas'=>$cuentas])->layout('layouts.master');;
    }
}
