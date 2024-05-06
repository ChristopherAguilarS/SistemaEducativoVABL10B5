<?php
namespace App\Livewire\Patrimonio\PorEquipo;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Rrhh\Trabajadores\TrabajadoresExport;
use DB;
use \Mpdf\Mpdf as PDF; 

class Filtro extends Component{
    public $f_tipo, $f_condicion, $f_area, $anio, $r_val, $tab = 1, $apPaterno, $apMaterno, $nombres, $nroDocumento;
    public function mount(){
        // $this->anio = date('Y');
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
            $d = [];
            if($this->f_tipo){
                $d[] = "catalogo_tipo_trabajador_id = ".$this->f_tipo; 
            }
            if($this->f_condicion){
                $d[] = "catalogo_condiciones_id = ".$this->f_condicion; 
            }
            if($this->f_area){
                $d[] = "catalogo_area_id = ".$this->f_area; 
            }
            $d = implode(' and ', $d);
            if($d){
                $this->r_val = "(".$d.")";
            }else{
                $this->r_val = null;
            }
            
        }elseif($this->tab == 2){
            $this->r_val = "(apellidoPaterno like '%".$this->apPaterno."%' and apellidoMaterno like '%".$this->apMaterno."%' and nombres like '%".$this->nombres."%')";
        }elseif($this->tab == 3){
            $this->r_val = "numeroDocumento like '".$this->nroDocumento."'";
        }
        $this->dispatch('rTabla', $this->r_val, $this->anio);
    }
    public function descargar(){
        return Excel::download(new TrabajadoresExport(), 'Trabajadores al '.date('d-m-Y').'.xlsx');
    }
    public function render(){
        return view('livewire.patrimonio.por-equipo.filtro');
    }
}