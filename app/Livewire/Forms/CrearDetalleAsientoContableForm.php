<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearDetalleAsientoContableForm extends Form
{
    public $descripcion  = null;
    #[Rule('required')]
    public $cuenta_id = null;
    #[Rule('required')]
    public $monto = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
