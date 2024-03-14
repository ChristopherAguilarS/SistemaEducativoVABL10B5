<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CompraDetalleTemp extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = true;
    protected $table='log_compras_detalles_temp';
    protected $primaryKey = 'id';
    protected $fillable=[
        'item_id',
        'mod_cant',
        'partida_id',
        'almacen_id',
        'pedido_detalle_id',
        'almacen_tipo',
        'tipo_seleccion',
        'cantidad',
        'precio',
        'porcentaje_igv',
        'valor_igv',
        'com_igv',
        'com_con_igv',
        'com_par_con_igv',
        'com_par_sin_igv',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
