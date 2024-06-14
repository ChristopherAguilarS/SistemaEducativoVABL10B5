<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearProcesoForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;

    #[Rule('required')]
    public $macro_proceso_id  = null;

    public $macro_proceso_estado = null;
    
    public function limpiarCampos(){
        $this->reset(); 
    }
}
