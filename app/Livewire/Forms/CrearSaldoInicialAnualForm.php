<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CrearSaldoInicialAnualForm extends Form
{
    #[Rule('required')]
    public $año  = null;

    #[Rule('required')]
    public $cuenta_id  = null;

    #[Rule('required')]
    public $saldo_inicial_debe = null;

    #[Rule('required')]
    public $saldo_inicial_haber = null;
    
    public function limpiarCampos(){
        $this->reset(); 
    }
}
