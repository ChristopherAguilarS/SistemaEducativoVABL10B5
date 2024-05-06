<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Patrimonio\EquipoInventario;
use App\Models\RecursosHumanos\CatalogoArea;
class Equipo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_equipos';
    protected $primaryKey = 'Id';
    protected $fillable=[
        'Id',
        'ambiente_id',
        'CODIGO_ACTIVO',
        'GRUPO_BIEN',
        'CLASE_BIEN',
        'FAMILIA_BIEN',
        'ITEM_BIEN',
        'DESCRIPCION',
        'FECHA_ALTA',
        'MODELO',
        'MARCA',
        'ESTADO_CONSERV',
        'NRO_SERIE',
        'SIGA',
        'OBSERVACIONES',
        'imagen',
        'CODIGO_SUPERIOR',
        'COLOR',
        'ANCHO',
        'LARGO',
        'ALTO',
        'TIPO_ITEM',
        'SALIDA_ID',
        'prestamo',
        'prestamo_persona_id',
        'EN_USO',
        'FECHA_COMPRA',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function inventario(){
       return $this->belongsTo(EquipoInventario::class, 'id', 'equipo_id')
        ->where('estado', '=', 1);
    }
    public function area(){
       return $this->belongsTo(CatalogoArea::class, 'area_id');
    }

    public function scopeSearch($query,$val)
    {
        return $query
        ->where('Item','like','%'.$val.'%')
        ->Orwhere('FamiliaBien','like','%'.$val);
        //->Orwhere('fecha','=',$val)
        
    }
    
}
