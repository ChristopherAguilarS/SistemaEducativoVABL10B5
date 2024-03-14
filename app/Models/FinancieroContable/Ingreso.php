<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ingreso extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_ingresos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'proveedor_id',
        'almacen_id',
        'tipo_movimiento',
        'created_by',
        'created_at'
    ];
    public function compra(){
        return $this->belongsTo(Compra::class, 'id', 'ingreso_id');
    }
    public function proveedor() {
        return $this->belongsTo(CatalogoProveedor::class, 'proveedor_id', 'id');
    }
}
