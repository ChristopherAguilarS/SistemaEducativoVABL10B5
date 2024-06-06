<?php
namespace App\Livewire\Biblioteca;
use App\Models\Biblioteca\Libro;
use App\Models\Biblioteca\LibroReserva;
use Livewire\Component;

class Cards extends Component{
    public $total = 0, $daniados = 0, $reservados = 0, $pendientes = 0;
    public function render(){
        $tt = Libro::get();
        $tt2 = LibroReserva::where('estado', 2)->count();
        $this->total = $tt->count();
        $this->daniados = $tt->where('estado', 2)->count();
        $this->reservados = $tt->where('reservado_por', '!=', 0)->count();
        $this->pendientes = $this->reservados-$tt2;
        return view('livewire.biblioteca.cards');
    }
}