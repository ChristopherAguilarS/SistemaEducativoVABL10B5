<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Indicador extends Model
{
    protected $table = 'indicadores';
    use HasFactory;
    protected $fillable = [
        'actividad_operativa_id',
        'codigo',
        'descripcion',
        'meta',
        'meta_ejecutada',
        'porcentaje_avance',
        'responsables',
        'responsable_id',
        'bienes_servicios',
        'tareas',
        'fecha_inicio',
        'fecha_fin',
        'monto_asignado',
        'monto_ejecutado',
        'saldo',
        'monto_pia',
        'aumento_disminucion',
        'monto_pim',
        'estado',
        'created_by',
        'updated_by',
    ];
    /*protected $fillable = [
        'actividad_operativa_id',
        'codigo',
        'descripcion',
        'meta',
        'responsables',
        'bienes_servicios',
        'tareas',
        'fecha_inicio',
        'fecha_fin',        
        'monto_asignado',
        'monto_ejecutado',
        'saldo',
        'monto_pia',
        'aumento_disminucion',
        'monto_pim',
        'estado',
        'created_by',
        'updated_by',
    ];*/
    
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
    

    public function actividad_operativa(): BelongsTo
    {
        return $this->belongsTo('App\Models\ActividadOperativa', 'actividad_operativa_id', 'id');
    }

    public function tareas_ejecutadas(): HasMany
    {
        return $this->hasMany('App\Models\TareaEjecutada', 'indicador_id', 'id');
    }

    /*public function tareas(): HasMany
    {
        return $this->hasMany('App\Models\Tarea', 'indicador_id', 'id');
    }

    public function especificanivel2(): BelongsTo
    {
        return $this->belongsTo('App\Models\EspecificaNivel2', 'especifica_nivel_2_id', 'id');
    }

    public function centro_costo(): BelongsTo
    {
        return $this->belongsTo('App\Models\CentroCosto', 'centro_costo_id', 'id');
    }*/
}
