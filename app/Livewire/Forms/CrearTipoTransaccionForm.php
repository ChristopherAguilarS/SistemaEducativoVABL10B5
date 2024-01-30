<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearTipoTransaccionForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $codigo = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
