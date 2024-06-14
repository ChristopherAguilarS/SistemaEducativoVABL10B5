<?php

namespace App\Livewire\Academico\Curso;

use App\Models\ProgramaEstudio;
use Livewire\Component;

class Filtro extends Component
{
    public $programas = [];
    public $tipo_proceso_id;
    public $busqueda;
    
    public function mount(){
        $this->programas = ProgramaEstudio::where('estado',1)->get();
    }

    public function updatedTipoProcesoId(){
        $this->dispatch('enviarTipoProcesoId',$this->tipo_proceso_id);
    }

    public function updatedBusqueda(){
        $this->dispatch('enviarBusqueda',$this->busqueda);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.academico.curso.filtro');
    }
}
