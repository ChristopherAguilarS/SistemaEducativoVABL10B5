<?php
namespace App\Livewire\Patrimonio\PorPersona;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Rrhh\Trabajadores\TrabajadoresExport;
class Filtro extends Component{
    public $f_tipo, $f_condicion, $f_area, $mes;
    public function mount(){
       // $this->anio = date('Y');
    }
    public function updTable(){
        $this->dispatch('updTable', $this->f_tipo, $this->f_condicion, $this->f_area);
    }
    public function agregar(){
        $this->dispatch('agregar');
    }
    public function descargar(){
        return Excel::download(new TrabajadoresExport(), 'Trabajadores al '.date('d-m-Y').'.xlsx');
    }
    public function render(){
        return view('livewire.patrimonio.por-persona.filtro');
    }
}