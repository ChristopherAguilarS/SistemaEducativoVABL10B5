<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='configuracion_establecimiento';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'inventariado_anio',
        'estado'
    ];
}
