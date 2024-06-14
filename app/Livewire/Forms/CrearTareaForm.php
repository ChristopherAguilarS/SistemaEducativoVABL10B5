<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearTareaForm extends Form
{
    #[Rule('required')]
    public $indicador_id = null;
    public $codigo  = null;
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $meta = null;
    public $nro_pedido = null;
    public $tipo_requerimiento = null;
    public $monto_ejecutado = null;
    public $meta_ejecutada = null;
    public $porcentaje_avance = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
