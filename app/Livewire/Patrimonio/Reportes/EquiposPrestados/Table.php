<?php

namespace App\Livewire\Patrimonio\Reportes\EquiposPrestados;

use App\Models\Patrimonio\Equipo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $s_equipo = 0, $perPage = 20;

    #[On('rTabla')]
    public function rTabla($equipo){
        $this->s_equipo = $equipo;
    }
    public function render(){
        $posts = Equipo::leftjoin('log_equipos_prestados as ep', 'ep.equipo_id', 'log_equipos.id')
        ->join('rrhh_personas as p', 'p.id', 'ep.persona_id')
        ->join('rrhh_personas as p2', 'p2.id', 'ep.created_by')
        ->leftjoin('log_ambientes as a', 'a.id', 'log_equipos.ambiente_id')
        ->select('log_equipos.id', 'log_equipos.CODIGO_ACTIVO', 'ep.observaciones_entrega', 'ep.observaciones_devolucion', 'ep.created_at', 'ep.estado', 'ep.fecha_devolucion', 'a.nombre as ambiente','log_equipos.DESCRIPCION', 'log_equipos.OBSERVACIONES', 'log_equipos.ESTADO_CONSERV', 'log_equipos.id', DB::raw("CONCAT(p.apellidoPaterno, ' ', p.apellidoMaterno, ', ', p.nombres) AS trabajador"), DB::raw("CONCAT(p2.apellidoPaterno, ' ', p2.apellidoMaterno, ', ', p2.nombres) AS trabajador2"));

        if($this->s_equipo){
            $posts = $posts->where('log_equipos.id', $this->s_equipo);
        }
        $posts = $posts->orderBy('ep.id', 'desc')->paginate($this->perPage); 
        return view('livewire.patrimonio.reportes.equipos-prestados.table',['posts'=>$posts]);
    }
}