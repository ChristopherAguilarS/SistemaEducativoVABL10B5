<?php

namespace App\Livewire\Academico\ProgramaEstudios;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.academico.programa-estudios.filtro');
    }
}
