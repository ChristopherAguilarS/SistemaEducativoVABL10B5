<?php
namespace App\Livewire\Patrimonio\Ambientes;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Patrimonio\AmbientesExport;
use App\Models\Patrimonio\CatalogoPabellon;

class Filtro extends Component{
    public $estado, $pabellon, $pabellones;
    public function buscar(){
        $this->dispatch('rTabla', $this->estado, $this->pabellon);
    }
    public function descargar(){
        return Excel::download(new AmbientesExport($this->estado, $this->pabellon), 'Ambientes al '.date('d-m-Y').'.xlsx');
    }
    public function render(){
        $this->pabellones = CatalogoPabellon::where('estado', 1)->get();
        return view('livewire.patrimonio.ambientes.filtro');
    }
}