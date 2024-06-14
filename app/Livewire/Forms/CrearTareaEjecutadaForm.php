<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearTareaEjecutadaForm extends Form
{
    #[Rule('required')]
    public $indicador_id = null;
    #[Rule('required')]
    public $descripcion  = null;
    #[Rule('required')]
    public $importe  = null;
    #[Rule('required')]
    public $fecha_emision  = null;
    #[Rule('required')]
    public $responsable_id  = null;   
    public $tipo_requerimiento  = null; 
    public $nro_requerimiento  = null;
    public $tipo_comprobante  = null;  
    public $nro_comprobante = null; 
    public $documento = null;
    public $ruta_documento_sustento = null;
    #[Rule('required')]
    public $especifica_nivel_2_id  = null;

    

    public function limpiarCampos(){
        $this->reset(); 
    }
}
