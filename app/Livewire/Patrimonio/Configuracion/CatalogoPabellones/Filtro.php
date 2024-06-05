<?php
namespace App\Livewire\Patrimonio\Configuracion\CatalogoPabellones;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 0;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.patrimonio.configuracion.catalogo-pabellones.filtro');
    }
}