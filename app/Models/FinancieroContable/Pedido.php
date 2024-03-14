<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rrhh\Persona;
use App\Models\Logistica\PedidoDetalle;
use App\Models\Logistica\Almacen;
use App\Models\Logistica\Compra;
class Pedido extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_pedidos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'correlativo',
        'compra_id',
        'ingreso',
        'moneda_id',
        'codigo_manual',
        'trabajador_id',
        'almacen_id',
        'almacen_destino',
        'fecha',
        'tipo_id',
        'estado',
        'movimiento',
        'movimiento_usuario',
        'movimiento_fecha',
        'guia_id',
        'observaciones',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    //muestra el almacen de destino cuando es transferencia
    public function almacenOrigen(){
        return $this->belongsTo(Almacen::class, 'almacen_id', 'id');
    }
    public function almacenDestino(){
        return $this->belongsTo(Almacen::class, 'almacen_destino', 'id');
    }
    public function solicitante(){
        return $this->belongsTo(Persona::class, 'trabajador_id', 'id');
    }
    public function revisado(){
        return $this->belongsTo(Persona::class, 'updated_by');
    }
    public function compra(){
        return $this->belongsTo(Compra::class, 'compra_id', 'id')->withDefault([
            'correlativo' => 'N/E',
        ]);
    }
    public function aprobados(){
        return $this->hasMany(PedidoDetalle::class, 'pedido_id', 'id')->where('estado', 2);
    }
    public function pendientes(){
        return $this->hasMany(PedidoDetalle::class, 'pedido_id', 'id')->where('estado', 1);
    }
    public function rechazados(){
        return $this->hasMany(PedidoDetalle::class, 'pedido_id', 'id')->where('estado', 3);
    }
    public function aprobadosCount(){
        return $this->aprobados->count();
    }
    public function pendientesCount(){
        return $this->pendientes->count();
    }
    public function rechazadosCount(){
        return $this->rechazados->count();
    }
    public function getNombreCompletoAttribute(){
        if(isset($this->solicitante->nombres)){
            return $this->solicitante->nombres . ' ' . $this->solicitante->apellidoPaterno. ' ' . $this->solicitante->apellidoMaterno;
        }else{
            return null;
        }
        
        
    }
}
