<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearIndicadorPIMForm extends Form
{
    public $indicador_id = null;
    public $resolucion  = null;
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $importe = null;
    public $fecha = null;
    public $documento = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
