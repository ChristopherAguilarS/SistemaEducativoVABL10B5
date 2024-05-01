<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FinancieroContable\CatalogoCategoriaAlmacen;
class EquipoTemp extends Authenticatable {
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_equipos_temp';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nro',
        'almacen_id',
        'catalogoEquipos_id',
        'categoria_id',
        'compra_id',
        'pedido_detalle_id',
        'catalogoColor_id',
        'catalogoMarca_id',
        'modelo',
        'estado',
        'numeroSerie',
        'imagen',
        'certificacion',
        'observaciones',
        'mantenimiento',
        'partida_id',
        'precio',
        'columna',
        'nivel',
        'porcentaje_igv',
        'valor_igv',
        'com_igv',
        'com_sin_igv',
        'com_con_igv',
        'com_par_con_igv',
        'com_par_sin_igv',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
