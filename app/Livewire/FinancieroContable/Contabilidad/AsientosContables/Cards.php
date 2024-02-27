<?php

namespace App\Livewire\FinancieroContable\Contabilidad\AsientosContables;

use App\Models\AsientoContable;
use Livewire\Attributes\On;
use Livewire\Component;

class Cards extends Component
{

    public $fecha_inicio;
    public $fecha_fin;

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('actualizarCards')]
    public function render()
    {
        $deudor = AsientoContable::where('tipo',1)->where('estado',1)
        ->when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })
        ->sum('monto');
        $acreedor = AsientoContable::where('tipo',2)->where('estado',1)->sum('monto');    
        $saldo = $acreedor - $deudor;
        return view('livewire.financiero-contable.contabilidad.asientos-contables.cards',['deudor'=>$deudor,'acreedor'=>$acreedor,'saldo'=>$saldo]);
    }
}
