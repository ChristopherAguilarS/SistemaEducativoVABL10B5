<?php

namespace App\Livewire\FinancieroContable\Contabilidad\NotasContables;

use App\Models\NotaContable;
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
        $deudor = NotaContable::where('tipo',1)->where('estado',1)
        ->when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })
        ->sum('monto');
        $acreedor = NotaContable::where('tipo',2)->where('estado',1)->sum('monto');    
        $saldo = $acreedor - $deudor;
        return view('livewire.financiero-contable.contabilidad.notas-contables.cards',['deudor'=>$deudor,'acreedor'=>$acreedor,'saldo'=>$saldo]);
    }
}
