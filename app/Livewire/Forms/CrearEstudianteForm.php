<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearEstudianteForm extends Form
{
    #[Rule('required')]
    public $nro_estudiante = null;

    #[Rule('required')]
    public $persona_id = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
