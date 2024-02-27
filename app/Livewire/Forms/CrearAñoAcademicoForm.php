<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearAñoAcademicoForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $año = null;
    #[Rule('required')]
    public $fecha_inicio = null;
    #[Rule('required')]
    public $fecha_fin = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
