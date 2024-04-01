<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Compra extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = true;
    protected $table='log_compras';
    protected $primaryKey = 'id';
    protected $fillable=[
        'tipo',
        'correlativo',
        'ingreso_id',
        'ingreso_tipo',
        'guia_id',
        'trabajador_id',
        'proveedor_id',
        'almacen_id',
        'forma_pago_id',
        'facturacion',
        'fecha',
        'tipo_movimiento',
        'total',
        'fecha_entrega',
        'lugar_entrega',
        'observaciones',
        'estado',
        'moneda_id',
        'tipo_cambio',
        'usuario_aprueba',
        'usuario_aprueba_fecha',
        'created_by',
        'created_at',
        'cuotas',
        'cuota1',
        'monto1',
        'fecha1',
        'cuota2',
        'monto2',
        'fecha2',
        'cuota3',
        'monto3',
        'fecha3',
        'cuota4',
        'monto4',
        'fecha4',
        'created_ingreso_by',
        'created_ingreso_at',
        'updated_by',
        'updated_at'
    ];
}
