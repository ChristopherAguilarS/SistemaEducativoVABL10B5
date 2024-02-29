<?php

namespace App\Livewire\Academico\Academico\Matriculas;

use App\Models\Academico\Matricula;
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
        $especificas = Matricula::paginate(10);
        return view('livewire.academico.academico.matriculas.table',['especificas'=>$especificas]);
    }
}
