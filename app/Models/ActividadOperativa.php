<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActividadOperativa extends Model
{
    protected $table = 'actividades_operativas';
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'accion_estrategica_priorizada_id',        
        'monto_asignado',
        'monto_ejecutado',
        'saldo',
        'estado',
        'created_by',
        'updated_by',
    ];  
    
    public function plan_anual_trabajo(): BelongsTo
    {
        return $this->belongsTo('App\Models\PlanAnualTrabajo', 'plan_anual_trabajo_id', 'id');
    }

    public function accion_estrategica_priorizada(): BelongsTo
    {
        return $this->belongsTo('App\Models\AccionEstrategicaPriorizada', 'accion_estrategica_priorizada_id', 'id');
    }

    public function indicadores(): HasMany
    {
        return $this->hasMany('App\Models\Indicador', 'actividad_operativa_id', 'id');
    }

    public function contar_tareas_ejecutas()
    {
        return $this->indicadores()
            ->join('tarea_ejecutadas', 'indicadores.id', '=', 'tarea_ejecutadas.indicador_id')
            ->count();
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
