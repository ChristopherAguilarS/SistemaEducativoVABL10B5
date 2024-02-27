<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearCicloForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $tipo_ciclo_id = null;
    #[Rule('required')]
    public $año_academico_id = null;
    #[Rule('required')]
    public $fecha_inicio = null;
    #[Rule('required')]
    public $fecha_fin = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
