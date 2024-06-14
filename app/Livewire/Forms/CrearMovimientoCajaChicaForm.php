<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearMovimientoCajaChicaForm extends Form
{
    public $caja_chica_id = null;
    #[Rule('required')]
    public $fecha = null;
    #[Rule('required_if:tipo,2')]
    public $comprobante = null;
    #[Rule('required|integer')]
    public $tipo_movimiento = null;
    #[Rule('required')]
    public $descripcion = null;
    #[Rule('required|integer')]
    public $categoria_movimiento_id = null;
    #[Rule('required')]
    public $monto = null;
    #[Rule('required_unless:categoria_id,8')]
    public $indicador_id = null;
    #[Rule('required')]
    public $responsable_id = null;
    public $categoria_id = null;
    public $tipo_desembolso = null;
    public $nro_desembolso = null;
    
    public function limpiarCampos(){
        $this->reset(); 
    }
}
