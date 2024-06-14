<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ObjetivoEstrategico extends Model
{
    protected $table = 'objetivo_estrategicos';
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'codigo',
        'plan_anual_trabajo_id',
        'proceso_id',
        'monto_asignado',
        'monto_ejecutado',
        'saldo',
        'estado',
        'created_by',
        'updated_by'
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

    public function acciones_estrategicas_priorizadas(): HasMany
    {
        return $this->hasMany('App\Models\AccionEstrategicaPriorizada', 'objetivo_estrategico_id', 'id');
    }

    public function procesos_objetivos_estrategicos(): HasMany
    {
        return $this->hasMany('App\Models\ProcesoObjetivoEstrategico', 'objetivo_estrategico_id', 'id');
    }

    public function contar_tareas_ejecutas()
    {
        return $this->acciones_estrategicas_priorizadas()
            ->join('actividades_operativas', 'accion_estrategica_priorizadas.id', '=', 'actividades_operativas.accion_estrategica_priorizada_id')
            ->join('indicadores', 'actividades_operativas.id', '=', 'indicadores.actividad_operativa_id')
            ->join('tarea_ejecutadas', 'indicadores.id', '=', 'tarea_ejecutadas.indicador_id')
            ->count();
    }

    public function contar_indicadores()
    {
        return $this->acciones_estrategicas_priorizadas()
            ->join('actividades_operativas', 'accion_estrategica_priorizadas.id', '=', 'actividades_operativas.accion_estrategica_priorizada_id')
            ->join('indicadores', 'actividades_operativas.id', '=', 'indicadores.actividad_operativa_id')
            ->count();
    }

}
