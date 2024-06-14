<?php

namespace App\Livewire\Academico\AprobacionPostulante;

use App\Models\MovimientoCajaChica;
use Livewire\Attributes\On;
use Livewire\Component;

class Cards extends Component
{

    public $fecha_inicio;
    public $fecha_fin;
    public $caja_seleccionada;

    #[On('actualizarMovimientos')]
    public function actualizarMovimientos($caja_seleccionada,$fecha_inicio,$fecha_fin){
        $this->caja_seleccionada = $caja_seleccionada;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($caja_seleccionada,$fecha_inicio,$fecha_fin){
        $this->caja_seleccionada = $caja_seleccionada;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('actualizarCards')]
    public function render()
    {
        $fondos = MovimientoCajaChica::where('tipo_movimiento',1)->where('caja_chica_id',$this->caja_seleccionada)->whereIn('categoria_movimiento_id',[1,2,3])->where('estado',1)
        ->sum('monto');
        $egresos = MovimientoCajaChica::where('tipo_movimiento',2)->where('caja_chica_id',$this->caja_seleccionada)->where('estado',1)->sum('monto');  
        $saldo = $fondos - $egresos;
        return view('livewire.academico.aprobacion-postulante.cards',['fondos'=>$fondos,'egresos'=>$egresos,'saldo'=>$saldo]);
    }
}
