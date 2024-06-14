<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\ActividadesOperativas;

use App\Models\MovimientoCajaBanco;
use App\Models\MovimientoCajaChica;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{

    public $fecha_inicio;
    public $fecha_fin;

    

    public function render()
    {
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.actividades-operativas.index');
    }
}
