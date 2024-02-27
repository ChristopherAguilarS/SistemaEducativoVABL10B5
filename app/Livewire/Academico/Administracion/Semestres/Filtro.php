<?php

namespace App\Livewire\Academico\Administracion\Semestres;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.academico.administracion.semestres.filtro');
    }
}