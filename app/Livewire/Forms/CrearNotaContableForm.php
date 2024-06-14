<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearNotaContableForm extends Form
{
    public $codigo  = null;
    public $cuenta_debe_id = null;
    public $cuenta_haber_id = null;
    public $descripcion = null;
    #[Rule('required')]
    public $fecha = null;
    public $tipo = null;
    public $monto_debe = null;
    public $monto_haber = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
