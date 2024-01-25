<?php

namespace App\Livewire\Configuracion\Financiero\SubGenericaNivel1;

use App\Models\SubGenericaNivel1;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $subgenericas = SubGenericaNivel1::paginate(10);
        return view('livewire.configuracion.financiero.sub-generica-nivel-1.table',['subgenericas'=>$subgenericas]);
    }
}
