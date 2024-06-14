<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearActividadOperativaForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    public $codigo = null;
    #[Rule('required')]
    public $accion_estrategica_priorizada_id = null;
    #[Rule('required')]
    public $monto_asignado = null;
    public $monto_ejecutado = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
