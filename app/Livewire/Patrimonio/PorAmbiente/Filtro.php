<?php
namespace App\Livewire\Patrimonio\PorAmbiente;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Patrimonio\PorAmbientesExport;
use App\Models\Patrimonio\Ambiente;
use Livewire\Attributes\On;
class Filtro extends Component{
    public $ambientes, $ambiente, $anio, $r_val, $tab = 1, $apPaterno, $apMaterno, $nombres, $nroDocumento, $inventariado;
    public function mount(){
        $this->anio = date('Y');
        $this->ambientes = Ambiente::where('estado', 1)->get();
     }
     public function tab_sel($id){
        $this->tab = $id;
     }
    #[On('resetFiltroDocumentoPersona')]
    public function resetFiltroDocumentoPersona($doc){
        
    }
    #[On('resetFiltroNombrePersona')]
    public function buscar(){
        if($this->tab == 1){
            if($this->ambiente){
                $this->r_val = "ambiente_id = ".$this->ambiente; 
            }else {
                $this->r_val = null;
            }            
        }elseif($this->tab == 2){
            $this->r_val = "(apellidoPaterno like '%".$this->apPaterno."%' and apellidoMaterno like '%".$this->apMaterno."%' and nombres like '%".$this->nombres."%')";
        }elseif($this->tab == 3){
            $this->r_val = "numeroDocumento like '".$this->nroDocumento."'";
        }
        $this->dispatch('rTabla', $this->r_val, $this->anio, $this->inventariado);
    }
    public function descargar(){
        return Excel::download(new PorAmbientesExport($this->tab, $this->ambiente, $this->apPaterno, $this->apMaterno, $this->nombres, $this->nroDocumento, $this->anio, $this->inventariado), 'Inventario por Ambientes al '.date('d-m-Y').'.xlsx');
    }
    public function render(){
        return view('livewire.patrimonio.por-ambiente.filtro');
    }
}