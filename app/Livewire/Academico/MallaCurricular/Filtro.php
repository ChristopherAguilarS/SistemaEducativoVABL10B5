<?php

namespace App\Livewire\Academico\MallaCurricular;

use App\Models\TipoProceso;
use Livewire\Component;

class Filtro extends Component
{
    public $tipo_procesos = [];
    public $tipo_proceso_id;
    public $busqueda;
    
    public function mount(){
        
    }

    public function render()
    {
        return view('livewire.academico.malla-curricular.filtro');
    }
}
