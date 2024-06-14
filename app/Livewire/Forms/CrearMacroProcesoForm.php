<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearMacroProcesoForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;

    #[Rule('required')]
    public $tipo_proceso_id  = null;
    
    public function limpiarCampos(){
        $this->reset(); 
    }
}
