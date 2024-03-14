<?php

namespace App\Http\Controllers\Rrhh;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use App\Models\RecursosHumanos\VinculoLaboral;
class FuncionesCtrl extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function personaActiva(){
        $data = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
                ->leftjoin('rrhh_vinculo_detalle as vd', function ($join) {
                    $join->on('vd.vinculo_laboral_id', 'rrhh_vinculo_laboral.id')
                        ->where('vd.estado', DB::raw('1'));
                })
                ->join('rrhh_catalogo_cargos as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogo_cargo_id')
                ->select('p.id', 'numeroDocumento', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS noms"))
                ->orderby('noms');
        if (auth()->user()->master == 1 || auth()->user()->todoSucursales == 1) {
            return $data->where('rrhh_vinculo_laboral.estado', 1)->get()->toarray();
        }else{
            return $data->join('users_locales as l', 'l.local_id', 'rrhh_vinculo_laboral.local_id')
            ->where('rrhh_vinculo_laboral.estado', 1)
            ->where('user_id', auth()->user()->id)
            ->get();
        }
    }
}