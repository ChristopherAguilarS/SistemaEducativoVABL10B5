<?php

namespace App\Livewire\FinancieroContable\Contabilidad\MovimientoCajaChica;

use App\Models\CajaChica;
use App\Models\MovimientoCajaChica;
use Livewire\Attributes\On;
use Livewire\Component;

class Filtro extends Component
{
    public $apertura = false;
    public $cierre = false;
    public $caja_seleccionada;
    public $caja_seleccionada_id;
    public $cajas;

    public function mount(){
        $this->cajas = CajaChica::where('estado',1)->get();
        $c = CajaChica::where('estado',1)->orderBy('fecha_creacion')->first();
        $this->caja_seleccionada_id = optional($c)->id;
        $this->caja_seleccionada = CajaChica::find($this->caja_seleccionada_id);
        $apertura = MovimientoCajaChica::where('estado', 1)->first();
        if($apertura == null){
            $this->apertura = true;
        }
        else{
            $this->apertura = false;
        }
    }

    public function updatedCajaSeleccionadaId(){
        $this->caja_seleccionada = CajaChica::find($this->caja_seleccionada_id);
        $this->dispatch('actualizarMovimientos',$this->caja_seleccionada_id);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function aperturaCC(){
        $this->dispatch('apertura',$this->caja_seleccionada_id);
    }

    public function cierreCC(){
        $this->dispatch('cierre');
    }

    #[On('actualizarCards')]
    public function render()
    {
        return view('livewire.financiero-contable.contabilidad.movimiento-caja-chica.filtro');
    }
}
