<?php
namespace App\Livewire\Academico\Caja;
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
        return view('livewire.academico.caja.filtro');
    }
}