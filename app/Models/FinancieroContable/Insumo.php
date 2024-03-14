<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Logistica\PedidoDetalle;
use App\Models\Logistica\UnidadMedida;
use App\Models\Logistica\InsumoStock;
class Insumo extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_insumos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'descripcion',
        'catalogoCategoria_id',
        'catalogoCategoriaAlmacen_id',
        'stockMinimo',
        'catalogoUnidadMedida_id',
        'ubicacionFisica',
        'imagen',
        'modelo',
        'estado',
        'costo',
        'codigo_insumo',
        'tipo',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function medida(){
        return $this->belongsTo(UnidadMedida::class, 'catalogoUnidadMedida_id')->withDefault([
            'nombre' => '',
        ]);
    }
    public function stock(){
        return $this->belongsTo(InsumoStock::class, 'id', 'almacen_id')->withDefault([
            'stockActual' => 0,
            'catalogoUbicacionFisica_id' => '',
        ]);
    }
    public function PedidoDetalles() {
        return $this->morphMany(PedidoDetalle::class, 'item');
    }
}
