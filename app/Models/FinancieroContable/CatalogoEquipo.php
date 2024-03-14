<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CatalogoEquipo extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_catalogo_equipos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'estado',
        'imagen',
        'log_catalogo_equipos',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
