<?php

namespace App\Livewire\Configuracion\Financiero\Generica;

use App\Models\Generica;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $genericas = Generica::paginate(10);
        return view('livewire.configuracion.financiero.generica.table',['genericas'=>$genericas]);
    }
}
