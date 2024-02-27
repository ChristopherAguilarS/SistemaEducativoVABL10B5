<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearPlanAnualTrabajoForm extends Form
{
    
    #[Rule('required')]
    public $año = null;
    #[Rule('required')]
    public $nombre  = null;
    #[Rule('required')]
    public $ruc  = null;
    #[Rule('required')]
    public $resolucion  = null;
    #[Rule('required')]
    public $tipo_gestion  = null;
    #[Rule('required')]
    public $direccion  = null;
    #[Rule('required')]
    public $lista_servicios  = null;
    #[Rule('required')]
    public $nombre_director  = null;
    #[Rule('required')]
    public $fecha_inicio = null;
    #[Rule('required')]
    public $fecha_fin = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
