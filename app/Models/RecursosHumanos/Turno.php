<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_turnos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'horaInicio',
        'horaFin',
        'descripcion',
        'abreviatura',
        'horas',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
