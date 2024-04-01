<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CompraPedido extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = true;
    protected $table='log_compras_pedidos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'pedido_id',
        'compra_id',
        'ingreso',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
