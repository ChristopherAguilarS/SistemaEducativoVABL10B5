<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class InsumoKardex extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_insumos_kardex';
    protected $primaryKey = 'id';
    protected $fillable=[
        'insumo_id',
        'tipo',
        'insumoSalida_id',
        'entrada',
        'salida',
        'almacen_id',
        'compra_id',
        'pedido_id',
        'stockActual',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
