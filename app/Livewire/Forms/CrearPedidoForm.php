<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearPedidoForm extends Form
{
    public $requerimiento_id = null;
    public $nro_pedido = null;
    #[Rule('required')]
    public $responsable_id = null;
    public $proveedor_id = null;
    #[Rule('required')]
    public $tipo_pedido = null;
    public $folios = null;
    public $fecha_registro_requerimiento = null;
    public $fecha_aprobacion_requerimiento = null;
    #[Rule('required')]
    public $descripcion = null;
    public $comentarios = null;
    public $estado_proceso = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
