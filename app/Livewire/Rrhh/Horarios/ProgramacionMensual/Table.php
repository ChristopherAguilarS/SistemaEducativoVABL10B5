<?php

namespace App\Http\Livewire\Rrhh\Horarios\ProgramacionMensual;
use Livewire\Component;
use Livewire\WithPagination;
use DB;

use App\Models\Rrhh\VinculoLaboral;
use App\Models\Rrhh\PersonaProgramacion;
class Table extends Component
{
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $tipo, $estado = 1, $lugar, $perPage = 20;

    public function renderizar(){
        $this->render();
    }
    public function rtabla($selectLugar, $selectTipo, $selectEstado){
        $this->lugar = $selectLugar;
        $this->tipo = $selectTipo;
        $this->estado = $selectEstado;
    }
    public function render(){
       $data = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
        ->leftjoin('adm_locales as al', 'al.id', 'rrhh_vinculo_laboral.local_id')
        ->leftjoin('rrhh_programaciones_personas as pph', 'pph.persona_id','p.id')
        ->join('rrhh_catalogo_cargos as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogoCargo_id')
        ->select('p.id','pph.id as ide', 'rrhh_vinculo_laboral.estado','cc.nombre as cargo', 'catalogoTipo_id', 'al.nombre as proy', 'codigoProyecto as cod', 'fecha as inicio','numeroDocumento', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS nombres"));
        $data = $data->where('rrhh_vinculo_laboral.estado', 1);

        return view('livewire.rrhh.horarios.programacion-mensual.table',['posts' => $data->orderby('apellidoPaterno', 'asc')->orderby('apellidoMaterno', 'asc')->orderby('nombres', 'asc')->paginate($this->perPage)]);
    }
}