<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearPlanAnualTrabajoForm extends Form
{
    
    #[Rule('required')]
    public $año_academico_id = null;
    #[Rule('required')]
    public $nombre  = null;

    public $ruc  = null;

    public $resolucion  = null;

    public $tipo_gestion  = null;

    public $direccion  = null;

    public $lista_servicios  = null;

    public $nombre_director  = null;


    public function limpiarCampos(){
        $this->reset(); 
    }
}
