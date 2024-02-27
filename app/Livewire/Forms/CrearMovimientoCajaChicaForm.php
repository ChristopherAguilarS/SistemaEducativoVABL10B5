<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearMovimientoCajaChicaForm extends Form
{
    #[Rule('required_if:tipo,2')]
    public $comprobante = null;
    #[Rule('required')]
    public $fecha = null;
    #[Rule('required_unless:categoria_id,8')]
    public $cuenta_id = null;
    #[Rule('required')]
    public $descripcion = null;    
    #[Rule('required')]
    public $categoria_id = null;
    public $descripcion_categoria = null;
    #[Rule('required|integer')]
    public $tipo = null;
    #[Rule('required_unless:categoria_id,8')]
    public $monto = null;
    
    public function limpiarCampos(){
        $this->reset(); 
    }
}
