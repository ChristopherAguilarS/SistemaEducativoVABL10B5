<?php
namespace App\Livewire\Biblioteca;
use Livewire\Component;
use App\Models\MesaPartes\Expediente;
class Cards extends Component{
    public $pendientes = 0, $atendidos = 0, $tramite = 0, $denegados = 0, $total = 0;
    public function render(){
        $tt = Expediente::where('persona_id', auth()->user()->id)->get();
        $this->total = $tt->count();
        $this->pendientes = $tt->where('estado', 1)->count();
        $this->atendidos = $tt->where('estado', 2)->count();
        $this->tramite = $tt->where('estado', 3)->count();
        $this->denegados = $tt->where('estado', 4)->count();
        return view('livewire.biblioteca.cards');
    }
}