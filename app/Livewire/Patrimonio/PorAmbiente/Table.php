<?php

namespace App\Livewire\Patrimonio\PorAmbiente;

use App\Models\Patrimonio\Equipo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap', $r_val, $r_campo, $SelGrupo, $SelClase, $perPage = 20, $inventariado;
    public $anio;

    public function mount(){
        $this->anio = date('Y');
    }

    #[On('rTabla')]
    public function rTabla($r_val, $anio, $inventariado){
        $this->r_val = $r_val;
        $this->anio = $anio;
        $this->inventariado = $inventariado;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    #[On('updTable')]
    public function render(){
        $posts = Equipo::leftjoin('log_equipos_inventariados as lr', function ($join) {
            $join->on('lr.equipo_id', '=', 'log_equipos.id')
            ->on('lr.estado', '=', DB::raw('1'))
            ->on('lr.anio', '=', DB::raw($this->anio));
        })
        ->leftjoin('rrhh_personas as p', 'p.id', 'lr.persona_id')
        ->leftjoin('log_ambientes as a', 'a.id', 'log_equipos.ambiente_id')
        ->select('log_equipos.id', 'log_equipos.CODIGO_ACTIVO', 'a.nombre as ambiente', 'lr.id as inventariado','log_equipos.DESCRIPCION', 'log_equipos.OBSERVACIONES', 'log_equipos.ESTADO_CONSERV', 'log_equipos.id', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS trabajador"));
        if($this->inventariado){
            if($this->inventariado == 1){
                $posts = $posts->whereRaw('lr.id is not null');
            }elseif($this->inventariado == 2){
                $posts = $posts->whereRaw('lr.id is null');
            }
        }
        if($this->r_val){
            $posts = $posts->whereRaw($this->r_val);
        }
        $posts = $posts->orderBy('DESCRIPCION', 'ASC')->paginate($this->perPage); 
        return view('livewire.patrimonio.por-ambiente.table',['posts'=>$posts]);
    }
}