<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FinancieroContable\CatalogoFormaPago;
use App\Models\FinancieroContable\Moneda;
use App\Models\FinancieroContable\CatalogoProveedor;
use App\Models\FinancieroContable\PedidoDetalle;
use App\Models\FinancieroContable\CatalogoComprobanteCompra;
use App\Models\FinancieroContable\CatalogoDetraccion;
class CompraComprobante extends Authenticatable {
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_compras_comprobantes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'ingreso_id',
        'compra_id',
        'proveedor_id',
        'catalogo_comprobantes_compra_id',
        'serie',
        'correlativo',
        'porcentaje_igv',
        'fecha_vencimiento',
        'fecha_emision',
        'caja_chica_id',
        'catalogo_detraccion_id',
        'moneda_id',
        'total',
        'tipo_cambio',
        'catalogo_forma_pago_id',
        'pago_detraccion_id',
        'pago_proveedor_id',
        'pago_documento',
        'estado',
        'temp',
        'agregar',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'eliminar'
    ];
    public function detalle(){
        return $this->hasMany(PedidoDetalle::class,'comprobante_id', 'id');
    }
    public function formapago() {
        return $this->belongsTo(CatalogoFormaPago::class, 'catalogo_forma_pago_id', 'id')->withDefault([
            'descripcion' => 'No Especificado'
        ]);
    }
    public function tipocomprobante() {
        return $this->belongsTo(CatalogoComprobanteCompra::class, 'catalogo_comprobantes_compra_id');
    }
    public function proveedor() {
        return $this->belongsTo(CatalogoProveedor::class, 'proveedor_id')->withDefault([
            'id' => '',
            'nombre' => '',
        ]);
    }
    public function monedas(){
        return $this->belongsTo(Moneda::class, 'moneda_id', 'id')->withDefault([
            'nombre' => 'N/E'
        ]);
    }
    public function dettraccion(){
        return $this->belongsTo(CatalogoDetraccion::class, 'catalogo_detraccion_id');
    }
}
