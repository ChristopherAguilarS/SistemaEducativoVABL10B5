<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearAsientoContableForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $fecha = null;
    #[Rule('required|array|min:1')]
    public $detalleDebe = [];
    #[Rule('required|array|min:1')]
    public $detalleHaber = [];

    public function limpiarCampos(){
        $this->reset(); 
    }
}
