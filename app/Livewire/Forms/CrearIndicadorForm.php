<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearIndicadorForm extends Form
{
    #[Rule('required')]
    public $actividad_operativa_id = null;
    #[Rule('required')]
    public $codigo  = null;
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $meta = null;
    #[Rule('required')]
    public $responsables  = null;
    #[Rule('required')]
    public $bienes_servicios  = null;    
    #[Rule('required')]
    public $fecha_inicio = null;
    #[Rule('required')]
    public $fecha_fin = null;
    #[Rule('required')]
    public $presupuesto  = null;
    #[Rule('required')]
    public $sub_generica_id  = null;
    #[Rule('required')]
    public $centro_costo_id  = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
