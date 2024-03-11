<?php

namespace App\Http\Livewire\Rrhh\Inicio;
use DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Rrhh\VinculoLaboral;
use App\Models\Rrhh\VinculoLaboralDetalle;
class Base extends Component
{
    use LivewireAlert;

    public $liquidaciones, $contratos = 0;
    public function render(){
        $data = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
            ->join('rrhh_hoja_recorrido as hr', 'hr.id', 'rrhh_vinculo_laboral.id')
            ->join('adm_locales as al', 'al.id', 'rrhh_vinculo_laboral.local_id')
            ->join('rrhh_catalogo_cargos as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogoCargo_id')
            ->select('hr.id', 'cc.nombre as cargo','catalogoTipo_id', 'al.nombre as proy', 'codigoProyecto as cod', 'numeroDocumento', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS nombres"), 'rrhh_vinculo_laboral.fecha', 'rrhh_vinculo_laboral.acuerdoTipo', 'rrhh_vinculo_laboral.acuerdoMonto', 'rrhh_vinculo_laboral.acuerdoBono', 'rrhh_vinculo_laboral.estado', 'apAdmin', 'obAdmin', 'apRrhh', 'obRrhh', 'apOpera', 'obOpera', 'apLogis', 'obLogis', 'obFech', 'apSiste', 'obSiste', 'apAdminGen', 'obAdminGen', 'apTrans', 'obTrans', 'apAlm', 'obAlm', 'apCal', 'obCal');
            $data = $data->where('apAdmin', 2)
                ->orWhere('apRrhh', 2)
                ->orWhere('apOpera', 2)
                ->orWhere('apLogis', 2)
                ->orWhere('apSiste', 2)
                ->orWhere('apAdminGen', 2)
                ->orWhere('apTrans', 2)
                ->orWhere('apAlm', 2)
                ->orWhere('apCal', 2);
        $this->contratos = VinculoLaboralDetalle::where('estado', 1)->whereraw("fechaFin >= '".date('Y-m-d')."'")->count();
        $this->liquidaciones = $data->get()->count();
        return view('livewire.rrhh.inicio.base');
    }
}
