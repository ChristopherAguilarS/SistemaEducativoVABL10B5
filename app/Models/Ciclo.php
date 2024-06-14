<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ciclo extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'tipo_ciclo_id',
        'año_academico_id',
        'vacantes',
        'libres',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'condicion',
        'created_by',
        'updated_by'
    ];

    public function tipo_ciclo(): BelongsTo
    {
        return $this->belongsTo('App\Models\TipoCiclo', 'tipo_ciclo_id', 'id');
    }

    public function año_academico(): BelongsTo
    {
        return $this->belongsTo('App\Models\AñoAcademico', 'año_academico_id', 'id');
    }

    protected function nEstado(): Attribute
    {
        $resultado = null;
        if($this->estado == 1){
            $resultado =  'Activo';
        }
        else{
            $resultado = 'Inactivo';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }
}
