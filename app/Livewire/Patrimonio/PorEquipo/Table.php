<?php

namespace App\Livewire\Patrimonio\PorEquipo;

use App\Models\Patrimonio\Equipo;
use App\Models\SubGenericaNivel2;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap', $r_val, $r_campo, $anio, $SelGrupo, $SelClase, $perPage = 20;
    public $SelAnio;

    public function mount(){
        $this->SelAnio = date('Y');
        $this->subgenericas = SubGenericaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('rTabla')]
    public function rTabla($r_val, $anio){
        $this->r_val = $r_val;
        $this->anio = $anio;
    }
    
    #[On('updTable')]
    public function render(){
        $posts = Equipo::leftjoin('log_equipos_inventariados as lr', function ($join) {
            $join->on('lr.equipo_id', '=', 'log_equipos.id')
                ->on('lr.estado', '=', DB::raw('1'));
        })
        ->leftjoin('rrhh_personas as p', 'p.Id', 'lr.persona_id')
        ->select('log_equipos.id','log_equipos.CODIGO_ACTIVO', 'log_equipos.DESCRIPCION', 'log_equipos.OBSERVACIONES', 'log_equipos.ESTADO_CONSERV', 'log_equipos.id', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS trabajador"));
        if($this->r_val){
            $posts = $posts->whereRaw($this->r_val);
        }
        /*
        if ($this->SelGrupo!=0) {
            $posts = $posts->where('GRUPO_BIEN', $this->SelGrupo);
        }
        if ($this->SelClase!=0) {
            $posts = $posts->where('CLASE_BIEN', $this->SelClase);
        }
        */
        $posts = $posts->orderBy('DESCRIPCION', 'ASC')->paginate($this->perPage); 
        return view('livewire.patrimonio.por-equipo.table',['posts'=>$posts]);
    }
}