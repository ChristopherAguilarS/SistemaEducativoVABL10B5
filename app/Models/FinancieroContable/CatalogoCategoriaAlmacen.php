<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CatalogoCategoriaAlmacen extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_catalogo_categorias_almacenes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'icon',
        'tipo',
        'estado',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
