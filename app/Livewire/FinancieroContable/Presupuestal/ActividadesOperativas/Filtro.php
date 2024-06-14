<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ActividadesOperativas;

use App\Models\ObjetivoEstrategico;
use Livewire\Component;

class Filtro extends Component
{
    
    public $objetivos_estrategicos;

    public function mount(){
        $this->objetivos_estrategicos = ObjetivoEstrategico::where('estado',1)->get();
    }
    
    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.actividades-operativas.filtro');
    }
}
