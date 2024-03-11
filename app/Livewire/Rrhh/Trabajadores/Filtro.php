<?php
namespace App\Livewire\Rrhh\Trabajadores;
use Livewire\Component;
class Filtro extends Component{
    public $f_tipo, $f_condicion, $f_area;
    public function mount(){
       // $this->anio = date('Y');
    }
    public function updTable(){
        $this->dispatch('updTable', $this->f_tipo, $this->f_condicion, $this->f_area);
    }
    public function agregar(){
        $this->dispatch('agregar');
    }
    public function render(){
        return view('livewire.rrhh.trabajadores.filtro');
    }
}