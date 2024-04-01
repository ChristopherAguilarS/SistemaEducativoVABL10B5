<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProgramacionAutomatica extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='rrhh_programaciones_automaticas';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'estado',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
