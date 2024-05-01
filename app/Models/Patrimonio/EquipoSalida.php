<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoSalida extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_equipos_salidas';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'equipo_id',
        'inicio',
        'fin',
        'destino',
        'created_at',
        'created_by'
    ];
}
