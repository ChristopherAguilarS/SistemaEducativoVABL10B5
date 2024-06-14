<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearDetalleRequerimientoForm extends Form
{
    #[Rule('required')]
    public $item_id = null;
    #[Rule('required')]
    public $cantidad_solicitada = null;
    #[Rule('required')]
    public $especificaciones = null;

    public function limpiarCampos(){
        $this->reset(); 
    }
}
