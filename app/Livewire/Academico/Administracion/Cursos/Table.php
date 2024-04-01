<?php

namespace App\Livewire\Academico\Administracion\Cursos;

use App\Models\Academico\Curso;
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
        $especificas = Curso::paginate(10);
        return view('livewire.academico.administracion.cursos.table',['especificas'=>$especificas]);
    }
}
