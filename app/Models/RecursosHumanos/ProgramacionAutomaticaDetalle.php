<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProgramacionAutomaticaDetalle extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='rrhh_programaciones_automaticas_detalle';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'dia',
        'turno_id',
        'estado',
        'programacionAutomatica_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
