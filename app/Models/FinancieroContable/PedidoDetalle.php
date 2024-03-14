<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Logistica\Insumo;
use App\Models\Logistica\CatalogoEquipo;
use App\Models\Logistica\Pedido;
use App\Models\Logistica\Almacen;
use App\Models\Logistica\Compra;
use App\Models\Logistica\CompraComprobante;
class PedidoDetalle extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_pedidos_detalles';
    protected $primaryKey = 'id';
    protected $fillable=[
        'pedido_id',
        'compra_id',
        'item_id',
        'item_tipo',
        'item_equipo_id',
        'partida_id',
        'precio',
        'almacen_id',
        'cantidad',
        'cantidad_aprobada',
        'cantidad_pendiente_envio',
        'comprobante_id',
        'estado',
        'aprobacionUser_id',
        'aprobacionFecha',
        'valor_igv',
        'porcentaje_igv',
        'com_sin_igv',
        'com_igv',
        'com_con_igv',
        'com_par_con_igv',
        'com_par_sin_igv',
        'tipo_seleccion',
        'info',
        'info_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'eliminar',
        'eliminar2'
    ];
    public function equipo(){
        return $this->belongsTo(CatalogoEquipo::class, 'item_id');
    }
    public function compra(){
        return $this->belongsTo(Compra::class, 'compra_id')->withDefault([
            'fecha' => 'N/E',
            'serie' => 'N/E',
            'correlativo' => 'N/E',
        ]);
    }
    public function comprobante(){
        return $this->belongsTo(CompraComprobante::class, 'comprobante_id')->withDefault([
            'moneda_id' => 0,
        ]);
    }
    public function almacen(){
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }

    public function insumo(){
        return $this->belongsTo(Insumo::class, 'item_id')->withDefault([
            'nombre' => '',
        ]);;
    }
    public function pedido(){
        return $this->belongsTo(Pedido::class, 'pedido_id')->withDefault([
            'correlativo' => 'N/E',
        ]);
    }
    /*
    public function comprobantes(){
        return $this->hasMany(CompraComprobante::class, 'id', 'comprobante_id');
    }
    public function obtenerTodosLosComprobantesAttribute(){
        if ($this->comprobantes) {
            return $this->comprobantes->map(function ($comprobante) {
                return $comprobante->serie . ' - ' . $comprobante->correlativo;
            })->implode(', ');
        } else {
            return '';
        }
    }
    */
}
