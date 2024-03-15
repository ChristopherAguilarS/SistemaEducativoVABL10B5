<?php

namespace App\Http\Controllers\FinancieroContable;


use Illuminate\Routing\Controller as BaseController;
use App\Models\FinancieroContable\Almacen;
use App\Models\FinancieroContable\Insumo;
use App\Models\FinancieroContable\CatalogoEquipo;
use DB;
use App\Models\FinancieroContable\Equipo;
class FuncionesCtrl extends BaseController{
    public $alm;
    //MUESTRA TODOS LOS INSUMOS CON EL STOCK DEL ALMACEN INGRESADO COMO VARIABLE, DE ENVIAR $almacen=0 MOSTRARA TODOS LOS INSUMOS REGISTRADOS
    public function InsumoStock($tipo, $almacen, $search, $ubi = 0){
        $this->alm = $almacen;
        $data = Insumo::join('log_insumos_stock as i', 'i.insumo_id', 'log_insumos.id')
            ->leftjoin('log_catalogo_unidad_medida as um', 'um.id', 'log_insumos.catalogoUnidadMedida_id')
            ->select('log_insumos.nombre', 'log_insumos.id', 'stockActual', 'um.nombre as medida')->where('almacen_id', $almacen)
            ->where('catalogoCategoriaAlmacen_id', $tipo)
            ->where('log_insumos.estado', 1)
            ->where('log_insumos.tipo', 1);

        if($search){
            $palabrasClave = explode(' ', $search);
            $data = $data->where(function ($query) use ($palabrasClave) {
                foreach ($palabrasClave as $palabra) {
                    $query->whereRaw("(log_insumos.nombre LIKE ? OR CONCAT('HMI-', log_insumos.id) LIKE ?)", ['%' . $palabra . '%', '%' . $palabra . '%']);
                }
            });
            $data->orderByRaw("CASE WHEN log_insumos.nombre = ? THEN 0 ELSE 1 END", [$search]);
        }
        if($ubi){
            $data = $data->where('i.catalogoUbicacionFisica_id', $ubi);
        }
        return $data->take(10)->get();
    }
    public function obtCorrelativoOrden($tipo){
        if($tipo == 1 || $tipo == 3){
            $tipo = [1,3];
        }else{
            $tipo = [2];
        }
        $data = Almacen::join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'log_almacenes.categoria_id')
            ->join('log_compras as c', 'c.almacen_id', 'log_almacenes.id')
            ->whereIn('categoria_id', $tipo)
            ->max('correlativo');
            
        if(!$data){
            $data = 1;
        }else{
            $data = $data + 1;
        }
        return $data;
    }
    public function obtCorrelativoPedido($alm, $tipo){
        if($tipo == 1 || $tipo == 3){
            $tipo = [1,3];
        }else{
            $tipo = [2];
        }
        $data = Almacen::join('log_catalogo_categorias_almacenes as cc', 'cc.id', 'log_almacenes.categoria_id')
            ->join('log_pedidos as c', 'c.almacen_id', 'log_almacenes.id')  
            ->where('log_almacenes.id', $alm)
            ->whereIn('categoria_id', $tipo)
            ->max('correlativo');
        if(!$data){
            $data = 1;
        }else{
            $data = $data + 1;
        }
        return $data;
    }
    public function InsumoAll($tipo, $almacen, $search){
        $this->alm = $almacen;
        $data = Insumo::leftjoin('log_insumos_stock as i', function ($join) {
            $join->on('i.insumo_id', 'log_insumos.id')
                ->where('i.almacen_id', $this->alm);
            })
            ->leftjoin('log_catalogo_unidad_medida as um', 'um.id', 'log_insumos.catalogoUnidadMedida_id')
            ->select('log_insumos.nombre', 'log_insumos.id', 'stockActual', 'um.nombre as medida')
            ->where('log_insumos.estado', 1)
            ->where('log_insumos.tipo', $tipo);

            if($search){
                $palabrasClave = explode(' ', $search);
                $data = $data->where(function ($query) use ($palabrasClave) {
                    foreach ($palabrasClave as $palabra) {
                        $query->whereRaw("(log_insumos.nombre LIKE ? OR CONCAT('HMI-', log_insumos.id) LIKE ?)", ['%' . $palabra . '%', '%' . $palabra . '%'])
                        ;
                    }
                });
                $data->orderByRaw("CASE WHEN log_insumos.nombre = ? THEN 0 ELSE 1 END", [$search]);
            }

        return $data->take(10)->get();
    }
    public function EquipoAll($tipo, $almacen, $search){
        $data = CatalogoEquipo::select('id', 'nombre', DB::raw("('') AS numeroSerie"),  DB::raw("'' AS marca"));
        if($search){
            $palabrasClave = explode(' ', $search);
            $data = $data->where(function ($query) use ($palabrasClave) {
                foreach ($palabrasClave as $palabra) {
                    $query->whereRaw("nombre LIKE ?", ['%' . $palabra . '%']);
                }
            });
            $data->orderByRaw("CASE WHEN nombre = ? THEN 0 ELSE 1 END", [$search]);
        }
        return $data->take(10)->get();
    }
    public function EquipoStock($tipo, $almacen, $search){
        $data = Equipo::join('log_equipos_rotaciones as lr', function ($join) {
            $join->on('lr.equipo_id', '=', 'log_equipos.id')
                ->where('lr.estado', 1)
                ->where('lr.tipoDestino', 1);
        })
            ->join('log_catalogo_equipos as lc', 'lc.id', 'log_equipos.catalogoEquipos_id')
            ->leftjoin('log_catalogo_marcas as lm', 'lm.id', 'log_equipos.catalogoMarca_id')
            ->select('log_equipos.id', 'lc.nombre', 'log_equipos.estado', 'log_equipos.numeroSerie AS serie', DB::raw("CASE CONCAT(lr.columna, ' - ', lr.nivel) WHEN '0 - 0' THEN '-' END AS tipo"), "lm.nombre AS marca")
            ->where('lr.destino_id', $almacen)->orderby('lc.nombre', 'asc');
        if($search){
            $palabrasClave = explode(' ', $search);
            $data = $data->where(function ($query) use ($palabrasClave) {
                foreach ($palabrasClave as $palabra) {
                    $query->whereraw("lc.nombre like '%".$palabra."%' or log_equipos.numeroSerie like '%".$palabra."%'");
                }
            });
            $data->orderByRaw("CASE WHEN lc.nombre = ? THEN 0 ELSE 1 END", [$search]);
        }
        return $data->take(10)->get();
    }
} 