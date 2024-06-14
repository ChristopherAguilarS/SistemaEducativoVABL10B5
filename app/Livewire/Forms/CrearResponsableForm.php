<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearResponsableForm extends Form
{
    #[Rule('required')]
    public $descripcion = null;
    #[Rule('required')]
    public $tipo_responsable  = null;
    #[Rule('required_if:tipo_responsable,1')]
    public $responsable_id  = null;
    #[Rule('required_if:tipo_responsable,2')]
    public $responsables_id  = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
