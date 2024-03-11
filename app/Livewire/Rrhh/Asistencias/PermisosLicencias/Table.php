<?php

namespace App\Http\Livewire\Rrhh\Asistencias\PermisosLicencias;
use Livewire\Component;
use Livewire\WithPagination;
use DB;

use App\Models\Rrhh\VinculoLaboral;
use App\Models\Administracion\Local;

class Table extends Component
{
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $anio, $mes, $tipo = 0, $estado = 2, $lugar, $perPage = 20;

    public function renderizar(){
        $this->render();
    }
    public function rtabla($lugar, $mes, $anio, $estado, $tipo){
        $this->lugar = $lugar;
        $this->mes = $mes;
        $this->anio = $anio;
        $this->estado = $estado;
        $this->tipo = $tipo;
    }
    public function render(){
       $data = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
        ->join('adm_locales as al', 'al.id', 'rrhh_vinculo_laboral.local_id')
        ->join('rrhh_catalogo_cargos as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogoCargo_id')
        ->select('rrhh_vinculo_laboral.id', 'nombreCorto','cc.nombre as cargo', DB::raw('(SELECT sum(dias) FROM rrhh_ausencias ra where ra.vinculoLaboral_id = rrhh_vinculo_laboral.id and ra.motivoAusencia_id = 1) AS vacaciones'), DB::raw('(SELECT sum(dias) FROM rrhh_ausencias ra where ra.vinculoLaboral_id = rrhh_vinculo_laboral.id and ra.motivoAusencia_id = 2) AS permisos'), DB::raw('(SELECT sum(dias) FROM rrhh_ausencias ra where ra.vinculoLaboral_id = rrhh_vinculo_laboral.id and ra.motivoAusencia_id = 3) AS licencias'),'catalogoTipo_id', 'al.nombre as proy', 'codigoProyecto as cod', 'numeroDocumento', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS nombres"), 'rrhh_vinculo_laboral.fecha', 'rrhh_vinculo_laboral.acuerdoTipo', 'rrhh_vinculo_laboral.estado');
        if($this->lugar){
            $data = $data->where('rrhh_vinculo_laboral.local_id', $this->lugar);
        }else{
            if(!auth()->user()->master){
                $data = $data->whereRaw('rrhh_vinculo_laboral.local_id in (SELECT local_id FROM users_locales WHERE user_id='.auth()->user()->id.')');
            }
        }
        if ($this->tipo) {
            $data = $data->where('catalogoTipo_id', $this->tipo);
        }
        if ($this->estado == 1) {
            $data = $data->where('rrhh_vinculo_laboral.estado', 1);
        }elseif($this->estado == 0){
            $data = $data->whereIn('rrhh_vinculo_laboral.estado', [1, 2]);
        }
        /*
        if ($this->tipo) {
            $data = $data->where('grado_id', $this->grado);
        }
*/
       return view('livewire.rrhh.asistencias.permisos-licencias.table',['posts' => $data->orderby('nombres', 'asc')->paginate($this->perPage)]);
    }
}
