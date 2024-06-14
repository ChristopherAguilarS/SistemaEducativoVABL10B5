<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccionEstrategicaPriorizada extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'objetivo_estrategico_id',        
        'monto_asignado',
        'monto_ejecutado',
        'saldo',
        'estado',
        'created_by',
        'updated_by',
    ];  

    public function actividades_operativas(): HasMany
    {
        return $this->hasMany('App\Models\ActividadOperativa', 'accion_estrategica_priorizada_id', 'id');
    }

    public function objetivo_estrategico(): BelongsTo
    {
        return $this->belongsTo('App\Models\ObjetivoEstrategico', 'objetivo_estrategico_id', 'id');
    }

    public function contar_tareas_ejecutas()
    {
        return $this->actividades_operativas()
            ->join('indicadores', 'actividades_operativas.id', '=', 'indicadores.actividad_operativa_id')
            ->join('tarea_ejecutadas', 'indicadores.id', '=', 'tarea_ejecutadas.indicador_id')
            ->count();
    }
}
