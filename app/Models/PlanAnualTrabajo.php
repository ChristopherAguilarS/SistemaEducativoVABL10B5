<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlanAnualTrabajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'año_academico_id',
        'nombre',
        'ruc',
        'resolucion',
        'tipo_gestion',
        'direccion',
        'lista_servicios',
        'nombre_director',
        'vision',
        'mision',
        'estado',
        'created_by',
        'updated_by',
    ];

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

    public function actividades(): HasMany
    {
        return $this->hasMany('App\Models\ActividadOperativa', 'plan_anual_trabajo_id', 'id');
    }

    public function año_academico(): BelongsTo
    {
        return $this->belongsTo('App\Models\AñoAcademico', 'año_academico_id', 'id');
    }

}
