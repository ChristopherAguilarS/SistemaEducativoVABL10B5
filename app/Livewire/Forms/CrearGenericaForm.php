<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearGenericaForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $codigo = null;
    #[Rule('required')]
    public $tipo_transaccion_id = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
