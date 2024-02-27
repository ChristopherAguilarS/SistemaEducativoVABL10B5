<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearPersonaForm extends Form
{
    #[Rule('required')]
    public $nombres  = null;
    #[Rule('required')]
    public $ape_pat = null;
    #[Rule('required')]
    public $ape_mat = null;
    #[Rule('required')]
    public $tipo_documento = null;
    #[Rule('required')]
    public $nro_documento = null;
    #[Rule('required')]
    public $genero = null;
    #[Rule('required')]
    public $telefono = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
