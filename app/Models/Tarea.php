<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'indicador_id',
        'codigo',
        'descripcion',
        'monto_ejecutado',
        'meta',
        'meta_ejecutada',
        'porcentaje_avance',
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

    public function indicador(): BelongsTo
    {
        return $this->belongsTo('App\Models\Indicador', 'indicador_id', 'id');
    }

    public function tareas_ejecutadas(): HasMany
    {
        return $this->hasMany('App\Models\TareaEjecutada', 'tarea_id', 'id');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo('App\Models\Area', 'area_id', 'id');
    }

    public function especificanivel2(): BelongsTo
    {
        return $this->belongsTo('App\Models\EspecificaNivel2', 'especifica_nivel_2_id', 'id');
    }
}
