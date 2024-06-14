<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearCajaChicaForm extends Form
{
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $fecha_creacion = null;
    #[Rule('required')]
    public $responsable_id = null;
    #[Rule('required')]
    public $año_academico_id = null;
    public $monto_inicial = null;
    public $fuente_financiamiento = null;
    public $decreto = null;
    public $ruta_decreto = null;


    public function limpiarCampos(){
        $this->reset(); 
    }
}
