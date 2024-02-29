<?php
namespace App\Livewire\Academico\Academico\Matriculas;
use Livewire\Component;
class Filtro extends Component{
    public $anio;
    public function mount(){
        $this->anio = date('Y');
    }
    public function agregar(){
        $this->dispatch('agregar');
    }
    public function render(){
        return view('livewire.academico.academico.matriculas.filtro');
    }
}