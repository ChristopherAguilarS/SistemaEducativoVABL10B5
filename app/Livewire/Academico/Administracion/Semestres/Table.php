<?php

namespace App\Livewire\Academico\Administracion\Semestres;

use App\Models\Academico\Semestre;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[On('rTabla')]
    public function rTabla(){
        $this->render();
    }

    public function render()
    {
        $especificas = Semestre::paginate(10);
        return view('livewire.academico.administracion.semestres.table',['especificas'=>$especificas]);
    }
}
