<?php
namespace App\Livewire\Biblioteca\Configuracion\CatalogoTipoIngreso;
use Livewire\Component;
class Filtro extends Component{
    public $estado = 1;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado);
    }
    public function render(){
        return view('livewire.biblioteca.configuracion.catalogo-tipo-ingreso.filtro');
    }
}