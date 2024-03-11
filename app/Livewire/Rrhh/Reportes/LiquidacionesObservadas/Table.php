<?php

namespace App\Http\Livewire\Rrhh\Reportes\LiquidacionesObservadas;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Rrhh\VinculoLaboral;
use App\Models\Rrhh\HojaAprobacionTipo;
class Table extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $listeners = ['renderizar', 'rtabla'];
    public $tipo, $estado = 2, $aprobacion,$lugar, $perPage = 20, $search, $aprobaciones, $tipos = [];

    public function renderizar(){
        $this->render();
    }
    public function rtabla($selectLugar, $selectTipo, $selectAp){
        $this->lugar = $selectLugar;
        $this->tipo = $selectTipo;
        $this->aprobacion = $selectAp;
    }
    public function mount(){
        
    }
    public function render(){
        $pers = [];
        $data = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
            ->join('rrhh_hoja_recorrido as hr', 'hr.id', 'rrhh_vinculo_laboral.id')
            ->join('adm_locales as al', 'al.id', 'rrhh_vinculo_laboral.local_id')
            ->join('rrhh_catalogo_cargos as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogoCargo_id')
            ->select('hr.id', 'cc.nombre as cargo','catalogoTipo_id', 'al.nombre as proy', 'codigoProyecto as cod', 'numeroDocumento', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS nombres"), 'rrhh_vinculo_laboral.fecha', 'rrhh_vinculo_laboral.acuerdoTipo', 'rrhh_vinculo_laboral.acuerdoMonto', 'rrhh_vinculo_laboral.acuerdoBono', 'rrhh_vinculo_laboral.estado', 'apAdmin', 'obAdmin', 'apRrhh', 'obRrhh', 'apOpera', 'obOpera', 'apLogis', 'obLogis', 'obFech', 'apSiste', 'obSiste', 'apAdminGen', 'obAdminGen', 'apTrans', 'obTrans', 'apAlm', 'obAlm', 'apCal', 'obCal');
        if(!$this->aprobacion){
            $data = $data->where('apAdmin', 2)
                ->orWhere('apRrhh', 2)
                ->orWhere('apOpera', 2)
                ->orWhere('apLogis', 2)
                ->orWhere('apSiste', 2)
                ->orWhere('apAdminGen', 2)
                ->orWhere('apTrans', 2)
                ->orWhere('apAlm', 2)
                ->orWhere('apCal', 2);
        }else{
            $cd = 'ap'.$this->aprobacion;
            $data = $data->where($cd, 2);
        }
            
        $data = $data->where('rrhh_vinculo_laboral.estado', $this->estado);

        if ($this->tipo) {
            $data = $data->where('rrhh_vinculo_laboral.catalogoTipo_id', $this->tipo);
        }

        if($this->search){
            $data = $data->whereraw("((CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) like '%".$this->search."%') or (cc.nombre like '%".$this->search."%') or (al.nombre like '%".$this->search."%') or (numeroDocumento like '%".$this->search."%'))");
        }
        $data = $data->orderby('nombres', 'asc')->get();
        foreach($data as $dt){
            $pers[] = [
                'id' =>$dt->id,
                'nombres' =>$dt->nombres,
                'cargo' =>$dt->cargo,
                'catalogoTipo_id' =>$dt->catalogoTipo_id,
                'cod' =>$dt->cod,
                'proy' =>$dt->proy, 'fecha' =>$dt->fecha,
                'apAdmin' => $dt->apAdmin,
                'obAdmin' => $dt->obAdmin,
                'apRrhh' => $dt->apRrhh,
                'obRrhh' => $dt->obRrhh,
                'apOpera' => $dt->apOpera,
                'obOpera' => $dt->obOpera,
                'apLogis' => $dt->apLogis,
                'obLogis' => $dt->obLogis,
                'apSiste' => $dt->apSiste,
                'obSiste' => $dt->obSiste,
                'apAdminGen' => $dt->apAdminGen,
                'obAdminGen' => $dt->obAdminGen,
                'apTrans' => $dt->apTrans,
                'obTrans' => $dt->obTrans,
                'apAlm' => $dt->apAlm,
                'obAlm' => $dt->obAlm,
                'apCal' => $dt->apCal,
                'obCal' => $dt->obCal
            ];
        }
        $this->aprobaciones = HojaAprobacionTipo::join('rrhh_hoja_aprobaciones as a', 'a.id', 'rrhh_hoja_aprobaciones_tipo.hojaAprobacion_id')
            ->distinct()
            ->select('nombre','a.id', 'abreviatura')
            ->get();
        $this->tipos = HojaAprobacionTipo::select('hojaAprobacion_id','catalogoTipo_id')
            ->get();
       return view('livewire.rrhh.reportes.liquidaciones-observadas.table',['posts' => $pers]);
    }
}
