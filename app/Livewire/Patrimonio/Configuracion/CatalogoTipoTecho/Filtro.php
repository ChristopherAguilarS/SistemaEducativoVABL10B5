<?php
namespace App\Livewire\Patrimonio\Configuracion\CatalogoTipoTecho;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.patrimonio.configuracion.catalogo-tipo-techo.filtro');
    }
}