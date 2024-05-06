<?php
namespace App\Livewire\Rrhh\Configuracion\CatalogoAreas;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.rrhh.configuracion.catalogo-areas.filtro');
    }
}