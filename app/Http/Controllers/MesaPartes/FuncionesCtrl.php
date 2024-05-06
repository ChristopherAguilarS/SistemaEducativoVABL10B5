<?php

namespace App\Http\Controllers\MesaPartes;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use App\Models\MesaPartes\Remitente;
class FuncionesCtrl extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function remitenteDoc($tipo, $doc){
        $data = Remitente::select('id' , 'nombres')->where('tipo_remitente', $tipo)->where('documento', $doc)->first();
        if($data){

        }else{
            if($tipo == 1){
                $res = Http::get('https://api.apis.net.pe/v1/dni?numero='.$doc);
                $r1 = json_decode($res);
                if($r1->nombre){
                    $sav = Remitente::firstOrCreate([
                        'tipo_remitente' => $tipo,
                        'documento' => $doc,
                        'nombres' => $r1->nombre,
                        'created_by' => auth()->user()->id,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $data = $sav;
                }else{
                    $data = null;
                }
            }else{
                $res = Http::get('https://api.apis.net.pe/v1/ruc?numero='.$doc);
                $r1 = json_decode($res);
                if($r1->nombre){
                    $sav = Remitente::firstOrCreate([
                        'tipo_remitente' => $tipo,
                        'documento' => $doc,
                        'nombres' => $r1->nombre,
                        'created_by' => auth()->user()->id,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    $data = $sav;
                }else{
                    $data = null;
                }
            }
            
        }
        return $data;
    }
}