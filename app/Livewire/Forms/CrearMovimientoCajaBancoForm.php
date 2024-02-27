<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearMovimientoCajaBancoForm extends Form
{
    public $codigo  = null;
    #[Rule('required')]
    public $cuenta_id = null;
    #[Rule('required')]
    public $descripcion = null;
    #[Rule('required')]
    public $fecha = null;
    #[Rule('required')]
    public $tipo = null;
    #[Rule('required')]
    public $monto = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
