<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearAperturaCajaChicaForm extends Form
{
    #[Rule('required')]
    public $fecha_creacion = null;
    #[Rule('required')]
    public $monto_inicial = null;
    #[Rule('required')]
    public $decreto = null;


    public function limpiarCampos(){
        $this->reset(); 
    }
}
