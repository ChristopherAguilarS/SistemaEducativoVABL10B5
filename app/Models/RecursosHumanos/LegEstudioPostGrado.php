<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegEstudioPostGrado extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_leg_estudios_post_grado';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'institucion_nombre',
        'catalogo_tipo_estudio_id',
        'estado_estudio',
        'fecha_emision',
        'fecha_inicio',
        'fecha_fin',
        'programa',
        'persona_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
