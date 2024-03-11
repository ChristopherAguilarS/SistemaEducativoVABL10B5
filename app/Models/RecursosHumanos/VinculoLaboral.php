<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VinculoLaboral extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_vinculo_laboral';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'persona_id',
        'catalogo_cargo_id',
        'catalogo_condiciones_id',
        'catalogo_tipo_documento',
        'fecha_inicio',
        'fecha_fin',
        'catalogo_area_id',
        'airhsp',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
