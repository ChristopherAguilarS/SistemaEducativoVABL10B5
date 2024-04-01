<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PedidoDetalleTemp extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_pedidos_detalles_temp';
    protected $primaryKey = 'id';
    protected $fillable=[
        'item_id',
        'tarea_id',
        'almacen_id',
        'almacen_tipo',
        'cantidad',
        'precio',
        'tipo_movimiento',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
