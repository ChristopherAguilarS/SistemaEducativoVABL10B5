<?php

namespace App\Livewire\Configuracion\Contable\SaldoInicial;

use Carbon\Carbon;
use Livewire\Component;

class Filtro extends Component {
    public $años = ['2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033'];
    public $añoSeleccionado = null;
    public function mount(){
        $this->añoSeleccionado = Carbon::now()->year;
    }

    public function updatedAñoSeleccionado(){
        $this->dispatch('enviarAñoSeleccionado',$this->añoSeleccionado);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function render()
    {
        return view('livewire.configuracion.contable.saldo-inicial.filtro');
    }
}
