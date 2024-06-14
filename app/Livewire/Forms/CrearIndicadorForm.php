<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearIndicadorForm extends Form
{
    #[Rule('required')]
    public $actividad_operativa_id = null;
    public $codigo  = null;
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $meta = null;
    public $meta_ejecutada = null;
    public $porcentaje_avance = null;
    public $avance_meta = null;
    public $responsables  = null;
    public $responsable_id  = null;
    
    public $bienes_servicios  = null; 
    
    public $tareas  = null; 
    #[Rule('required')]
    public $fecha_inicio = null;
    #[Rule('required')]
    public $fecha_fin = null;

    #[Rule('required')]
    public $monto_asignado  = null;
    public $monto_ejecutado  = null;
    public $saldo  = null;
    
    public $monto_pia  = null;
    public $aumento_disminucion  = null;
    public $monto_pim  = null;
    /*#[Rule('required')]
    public $actividad_operativa_id = null;
    #[Rule('required')]
    public $codigo  = null;
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $meta = null;
    
    public $responsables  = null;
    
    public $bienes_servicios  = null;    
    
    public $fecha_inicio = null;
    
    public $fecha_fin = null;

    public $sub_generica_id  = null;

    public $centro_costo_id  = null;
    #[Rule('required')]
    public $monto_asignado  = null;
    public $monto_ejecutado  = null;
    public $saldo  = null;*/

    public function limpiarCampos(){
        $this->reset(); 
    }
}
