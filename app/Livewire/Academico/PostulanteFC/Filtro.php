<?php

namespace App\Livewire\Academico\PostulanteFC;

use Livewire\Component;

class Filtro extends Component
{
    public function agregar(){
        $this->dispatch('agregar');
    }
    
    public function render()
    {
        return view('livewire.academico.postulante-fc.filtro');
    }
}
