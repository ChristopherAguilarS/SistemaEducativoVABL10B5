<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegExperienciaLaboral extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_leg_estudios_experiencia_laboral';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'nombre_lugar',
        'cargo',
        'catalogo_tipo_lugar_id',
        'fecha_inicio',
        'fecha_fin',
        'persona_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
