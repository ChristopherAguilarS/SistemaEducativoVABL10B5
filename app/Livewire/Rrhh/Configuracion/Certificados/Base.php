<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Certificados;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Rrhh\TipoTrabajador;
use App\Models\Rrhh\FormatoCertificado;
class Base extends Component
{
    use LivewireAlert;
    protected $listeners = ['eliminar', 'borrar'];
    public $selectTipo = 0, $tipos, $cuerpo;
    public function up(){
        $data = FormatoCertificado::find($this->selectTipo);
        if($data){
            $this->cuerpo = $data->cuerpo;
            $this->emit("actualiza");
        }
    }
    public function verCertificado(){
        if($this->selectTipo){
            $this->emit('verCertificado', $this->selectTipo, 0);
        }else{
            $this->alert('error', 'Debes seleccionar un tipo de trabajador.');
        }
    }
    public function guardar(){
        if($this->selectTipo){
            $data = str_replace('<strong><span class="ql-cursor">﻿﻿﻿﻿﻿﻿</span></strong></p><p class="ql-align-right"><strong>', '<br>', $this->cuerpo);
            $sav = FormatoCertificado::updateorcreate(
                ['id' => $this->selectTipo],
                [
                    'id' => $this->selectTipo,
                    'cuerpo' => $data,
                ]
            );
            $this->alert('success', 'Guardado correctamente.');
        }else{
            $this->alert('error', 'Debes seleccionar un tipo de trabajador.');
        }
    }
    public function render(){
        $this->tipos = TipoTrabajador::get();
        return view('livewire.rrhh.configuracion.certificados.base');
    }
}
