<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegOtrosEstudios extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_leg_otros_estudios';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'institucion_nombre',
        'estudio_nombre',
        'codigo',
        'horas',
        'creditos',
        'fecha_inicio',
        'fecha_fin',
        'persona_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
