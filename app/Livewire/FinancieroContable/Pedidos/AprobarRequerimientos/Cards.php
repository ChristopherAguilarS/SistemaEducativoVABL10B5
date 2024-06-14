<?php

namespace App\Livewire\FinancieroContable\Pedidos\AprobarRequerimientos;

use App\Models\MovimientoCajaBanco;
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
        $deudor = MovimientoCajaBanco::where('tipo',1)->where('estado',1)
        ->when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })
        ->sum('monto');
        $acreedor = MovimientoCajaBanco::where('tipo',2)->where('estado',1)->sum('monto');        
        if($acreedor>$deudor){
            $saldo = $acreedor - $deudor;
        }
        else{
            $saldo = 0;
        }
        return view('livewire.financiero-contable.pedidos.aprobar-requerimientos.cards',['deudor'=>$deudor,'acreedor'=>$acreedor,'saldo'=>$saldo]);
    }
}
