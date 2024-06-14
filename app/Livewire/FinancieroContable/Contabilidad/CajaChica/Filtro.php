<?php

namespace App\Livewire\FinancieroContable\Contabilidad\CajaChica;

use App\Models\CajaChica;
use App\Models\MovimientoCajaChica;
use Livewire\Attributes\On;
use Livewire\Component;

class Filtro extends Component
{
    public $fecha_inicio;
    public $fecha_fin;
    public $apertura = false;
    public $cierre = false;
    public $caja_seleccionada;
    public $caja_seleccionada_id;
    public $cajas;

    public function mount(){
        $this->cajas = CajaChica::where('estado',1)->get();
        $c = CajaChica::where('estado',1)->orderBy('fecha_creacion')->first();
        $this->caja_seleccionada_id = optional($c)->id;
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
        $this->dispatch('actualizarMovimientos',$this->caja_seleccionada_id,$this->fecha_inicio,$this->fecha_fin);
    }

    public function updatedFechaInicio(){
        $this->dispatch('actualizarFechas',$this->caja_seleccionada_id,$this->fecha_inicio,$this->fecha_fin);
    }

    public function updatedFechaFin(){
        $this->dispatch('actualizarFechas',$this->caja_seleccionada_id,$this->fecha_inicio,$this->fecha_fin);
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function aperturaCC(){
        $this->dispatch('apertura');
    }

    public function cierreCC(){
        $this->dispatch('cierre');
    }

    #[On('actualizarCards')]
    public function render()
    {
        return view('livewire.financiero-contable.contabilidad.caja-chica.filtro');
    }
}
