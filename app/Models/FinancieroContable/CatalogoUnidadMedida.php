<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CatalogoUnidadMedida extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_catalogo_unidad_medida';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'codigo',
        'nombre',
        'estado'
    ];
}
