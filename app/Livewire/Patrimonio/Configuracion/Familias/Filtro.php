<?php
namespace App\Livewire\Patrimonio\Configuracion\Familias;
use Livewire\Component;
use App\Models\Patrimonio\Grupo;
use App\Models\Patrimonio\Clase;
class Filtro extends Component{
    public $grupo = 1, $clase = 0, $clases, $grupos;
    public function updatedGrupo($id){
        $this->clases = Clase::where('grupo', $id)->get();
    }
    public function buscar(){
        $this->dispatch('rTabla', $this->grupo, $this->clase);
    }
    public function mount(){
        $this->grupos = Grupo::get();
    }
    public function render(){
        return view('livewire.patrimonio.configuracion.familias.filtro');
    }
}