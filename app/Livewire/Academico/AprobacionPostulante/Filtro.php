<?php

namespace App\Livewire\Academico\AprobacionPostulante;

use App\Models\ProgramaEstudio;
use Livewire\Component;

class Filtro extends Component
{
    public $programas;
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function mount(){
        $this->programas = ProgramaEstudio::where('estado',1)->get();
    }
    
    public function render()
    {
        return view('livewire.academico.aprobacion-postulante.filtro');
    }
}
