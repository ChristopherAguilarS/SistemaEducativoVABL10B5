<?php

namespace App\Livewire\FinancieroContable\Presupuestal\Indicadores;

use App\Models\MovimientoCajaBanco;
use App\Models\MovimientoCajaChica;
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
        $fondos = MovimientoCajaChica::where('tipo',1)->whereIn('categoria_id',[1,2,3])->where('estado',1)
        ->sum('monto');
        $egresos = MovimientoCajaChica::where('tipo',2)->where('estado',1)->sum('monto');  
        $saldo = $fondos - $egresos;
        return view('livewire.financiero-contable.presupuestal.indicadores.cards',['fondos'=>$fondos,'egresos'=>$egresos,'saldo'=>$saldo]);
    }
}
