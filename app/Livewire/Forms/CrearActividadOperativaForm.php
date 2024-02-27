<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearActividadOperativaForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $codigo = null;
    #[Rule('required')]
    public $plan_anual_trabajo_id = null;
    #[Rule('required')]
    public $objetivo_estrategico_id = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
