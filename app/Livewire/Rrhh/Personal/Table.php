<?php

namespace App\Livewire\Rrhh\Personal;
use App\Models\RecursosHumanos\Persona;
use App\Models\SubGenericaNivel2;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estado = 1, $cumple = 0, $r_val, $selTab = 0;
    public function mount(){
        $this->subgenericas = SubGenericaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }
    public function selTab($id){
        $this->selTab = $id;
        $this->dispatch('selTab', $id);
    }
    #[On('rTabla')]
    public function rTabla(){
        $this->render();
    }
    #[On('rTablaEstado')]
    public function rTablaEstado($est, $cumple){
        $this->estado = $est;
        $this->cumple = $cumple;
    }
    #[On('resetFiltroDocumentoPersona')]
    public function resetFiltroDocumentoPersona($doc){
        $this->r_val = "numeroDocumento like '".$doc."'";
    }
    #[On('resetFiltroNombrePersona')]
    public function resetFiltroNombrePersona($ap1, $ap2, $nom){
        $this->r_val = "(apellidoPaterno like '%".$ap1."%' and apellidoMaterno like '%".$ap2."%' and nombres like '%".$nom."%')";
    }
    public function render(){
        $especificas = Persona::select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'numeroDocumento AS dni', 'email', 'telefonos', 'estado', 'id', DB::raw("MONTH(fechaNacimiento) as mes"));
        if($this->cumple){
            $especificas = $especificas->whereMonth('fechaNacimiento', $this->cumple);
        }
        if($this->estado == 1){
            $especificas = $especificas->where('estado', 1);
        }elseif($this->estado == 2){
            $especificas = $especificas->orderby('id', 'desc');
        }elseif($this->estado == 3){
            $especificas = $especificas->where('id', 0);
        }
        if($this->r_val){
            $especificas = $especificas->whereRaw($this->r_val);
        }
        $especificas = $especificas->paginate(10);
        return view('livewire.rrhh.personal.table',['especificas'=>$especificas]);
    }
}