<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CatalogoProveedor extends Authenticatable {
    public $timestamps = false;
    protected $table='log_catalogo_proveedores';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'abreviatura',
        'tipo_persona',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'ubigeo',
        'nombre_contacto',
        'telefono1',
        'telefono2',
        'direccion',
        'estado',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
