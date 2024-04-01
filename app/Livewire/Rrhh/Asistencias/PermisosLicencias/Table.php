<?php

namespace App\Livewire\Rrhh\Asistencias\PermisosLicencias;

use App\Models\RecursosHumanos\VinculoLaboral;
use App\Models\SubGenericaNivel2;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap', $r_val, $r_campo;

    public function mount(){
        $this->subgenericas = SubGenericaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('rTabla')]
    public function rTabla(){
        $this->render();
    }
    #[On('resetFiltroDocumentoPersona')]
    public function resetFiltroDocumentoPersona($doc){
        $this->r_val = "numeroDocumento like '".$doc."'";
    }
    #[On('resetFiltroNombrePersona')]
    public function resetFiltroNombrePersona($ap1, $ap2, $nom){
        $this->r_val = "(apellidoPaterno like '%".$ap1."%' and apellidoMaterno like '%".$ap2."%' and nombres like '%".$nom."%')";
    }
    #[On('updTable')]
    public function updTable($tipo, $condicion, $area){
        $d = [];
        if($tipo){
            $d[] = "catalogo_tipo_trabajador_id = ".$tipo; 
        }
        if($condicion){
            $d[] = "catalogo_condiciones_id = ".$condicion; 
        }
        if($area){
            $d[] = "catalogo_area_id = ".$area; 
        }
        $d = implode(' and ', $d);
        $this->r_val = "(".$d.")";
    }
    public function render(){
        $especificas = VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', 'p.id')
            ->leftjoin('rrhh_catalogo_condiciones as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogo_condiciones_id')
            ->leftjoin('rrhh_catalogo_areas as ca', 'ca.id', 'rrhh_vinculo_laboral.catalogo_area_id')
            ->select(
                DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 
                'numeroDocumento AS dni', 
                'rrhh_vinculo_laboral.id', 
                'rrhh_vinculo_laboral.fecha_inicio', 
                'ca.descripcion as area', 
                'catalogo_tipo_trabajador_id',
                DB::raw('(SELECT sum(dias) FROM rrhh_ausencias ra where ra.vinculoLaboral_id = rrhh_vinculo_laboral.id and ra.tipo = 1) AS vacaciones'), 
                DB::raw('(SELECT sum(dias) FROM rrhh_ausencias ra where ra.vinculoLaboral_id = rrhh_vinculo_laboral.id and ra.tipo = 2) AS permisos'), 
                DB::raw('(SELECT sum(dias) FROM rrhh_ausencias ra where ra.vinculoLaboral_id = rrhh_vinculo_laboral.id and ra.tipo = 3) AS licencias'),
                DB::raw('(SELECT sum(dias) FROM rrhh_ausencias ra where ra.vinculoLaboral_id = rrhh_vinculo_laboral.id and ra.tipo = 4) AS comisiones')
            );
        if($this->r_val){
            $especificas = $especificas->whereRaw($this->r_val);
        }
        $especificas = $especificas->paginate(10);
        return view('livewire.rrhh.asistencias.permisos-licencias.table',['especificas'=>$especificas]);
    }
}
