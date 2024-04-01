<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CompraPedidoTemp extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = true;
    protected $table='log_compras_pedidos_temp';
    protected $primaryKey = 'id';
    protected $fillable=[
        'pedido_id',
        'almacen_id',
        'almacen_tipo',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
