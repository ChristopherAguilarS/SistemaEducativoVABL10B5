<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearObjetivoEstrategicoForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    public $codigo = null;
    #[Rule('required')]
    public $monto_asignado = null;
    #[Rule('required')]
    public $plan_anual_trabajo_id = null;
    

    public function limpiarCampos(){
        $this->reset(); 
    }
}
