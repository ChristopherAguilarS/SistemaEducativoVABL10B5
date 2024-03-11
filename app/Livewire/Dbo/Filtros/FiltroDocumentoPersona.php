<?php

namespace App\Livewire\Dbo\Filtros;
use Livewire\Component;

class FiltroDocumentoPersona extends Component{
    public $nroDocumento;
    public function buscar(){
        if($this->nroDocumento == ''){
            $this->dispatchBrowserEvent(
                     'alert',
                     ['type' => 'error',  'message' => 'Debes ingresar un número de documento']
            );
        }else{
            $this->dispatch('resetFiltroDocumentoPersona', $this->nroDocumento);
        }
    }
    public function render(){
        return view('livewire.dbo.filtros.filtro-documento-persona');
    }
}
