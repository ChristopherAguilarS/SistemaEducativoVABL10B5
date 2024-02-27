<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearConceptoIngresoForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $fecha_vigencia  = null;
    #[Rule('required')]
    public $especifica_nivel_2_id = null;
    #[Rule('required')]
    public $tipo_ingreso_id = null;
    #[Rule('required')]
    public $ciclo_id = null;
    #[Rule('required')]
    public $tipo = null;
    #[Rule('required')]
    public $monto = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
