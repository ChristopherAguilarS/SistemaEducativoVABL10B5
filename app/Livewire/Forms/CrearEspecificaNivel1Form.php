<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearEspecificaNivel1Form extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $codigo = null;
    #[Rule('required')]
    public $sub_generica_nivel_2_id = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
