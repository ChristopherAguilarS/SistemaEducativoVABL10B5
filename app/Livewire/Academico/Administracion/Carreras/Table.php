<?php

namespace App\Livewire\Academico\Administracion\Carreras;

use App\Models\Academico\Carrera;
use App\Models\SubGenericaNivel2;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->subgenericas = SubGenericaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('rTabla')]
    public function rTabla(){
        $this->render();
    }

    public function render()
    {
        $especificas = Carrera::paginate(10);
        return view('livewire.academico.administracion.carreras.table',['especificas'=>$especificas]);
    }
}
