<?php

namespace App\Livewire\Dbo\Filtros;
use Livewire\Component;

class FiltroNombrePersona extends Component{
    public $apPaterno, $apMaterno, $nombres;
    public function buscar(){
       /* if($this->nroDocumento == ''){
            $this->dispatchBrowserEvent(
                     'alert',
                     ['type' => 'error',  'message' => 'Debes ingresar un número de documento']
            );
        }else{
            
        }
        */
        $this->dispatch('resetFiltroNombrePersona', $this->apPaterno, $this->apMaterno, $this->nombres);
    }
    public function render(){
        return view('livewire.dbo.filtros.filtro-nombre-persona');
    }
}
