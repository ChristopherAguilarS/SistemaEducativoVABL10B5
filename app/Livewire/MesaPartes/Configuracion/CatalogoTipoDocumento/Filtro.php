<?php
namespace App\Livewire\MesaPartes\Configuracion\CatalogoTipoDocumento;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.mesa-partes.configuracion.catalogo-tipo-documento.filtro');
    }
}