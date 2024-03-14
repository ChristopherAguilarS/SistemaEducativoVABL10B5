<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class IngresoDetalleTemp extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_ingresos_detalle_temp';
    protected $primaryKey = 'id';
    protected $fillable=[
        'item_id',
        'partida_id',
        'cantidad',
        'almacen_tipo',
        'almacen_id',
        'valor_igv',
        'porcentaje_igv',
        'com_sin_igv',
        'com_igv',
        'com_con_igv',
        'com_par_sin_igv',
        'com_par_con_igv',
        'created_by', 
        'created_at'
    ];
}
