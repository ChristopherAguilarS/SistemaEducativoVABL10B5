<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AprobarDetalleRequerimientoForm extends Form
{
    #[Rule('required')]
    public $item_id = null;
    #[Rule('required')]
    public $cantidad_aprobada = null;
    #[Rule('required')]
    public $ecomentarios = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
