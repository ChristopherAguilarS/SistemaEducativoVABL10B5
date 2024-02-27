<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearTipoCicloForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
