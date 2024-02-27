<?php

namespace App\Livewire\Academico\AñoAcademico;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.academico.año-academico.filtro');
    }
}
