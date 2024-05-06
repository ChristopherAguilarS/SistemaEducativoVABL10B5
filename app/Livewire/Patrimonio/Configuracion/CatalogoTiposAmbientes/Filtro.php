<?php
namespace App\Livewire\Patrimonio\Configuracion\CatalogoTiposAmbientes;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.patrimonio.configuracion.catalogo-tipos-ambientes.filtro');
    }
}