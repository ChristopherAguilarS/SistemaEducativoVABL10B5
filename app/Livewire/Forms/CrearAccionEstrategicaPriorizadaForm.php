<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearAccionEstrategicaPriorizadaForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    public $codigo = null;
    #[Rule('required')]
    public $objetivo_estrategico_id = null;
    public $monto_asignado = null;
    public $monto_ejecutado = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
