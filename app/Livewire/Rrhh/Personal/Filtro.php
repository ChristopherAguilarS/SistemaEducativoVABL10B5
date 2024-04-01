<?php
namespace App\Livewire\Rrhh\Personal;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Rrhh\Personas\PersonasExport;
use Livewire\Attributes\On;
class Filtro extends Component{
    public $estado = 1, $mes = 0, $selTab = 0;
    public function mount(){
        $this->anio = date('Y');
    }
    public function cEstado(){
        $this->dispatch('rTablaEstado', $this->estado, $this->mes);
    }
    #[On('selTab')]
    public function selTab($id){
        $this->selTab = $id;
    }
    public function descargar(){
        return Excel::download(new PersonasExport(), 'Personas al '.date('d-m-Y').'.xlsx');
    }
    public function render(){
        return view('livewire.rrhh.personal.filtro');
    }
}