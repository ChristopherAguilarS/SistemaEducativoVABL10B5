<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TareaEjecutada extends Model
{
    use HasFactory;
    protected $fillable = [               
        'indicador_id', 
        'descripcion',          
        'importe',
        'tipo_requerimiento',
        'nro_requerimiento',
        'tipo_comprobante',
        'comprobante', 
        'nombre_documento_sustento',
        'ruta_documento_sustento',
        'fecha_emision_documento',
        'responsable_id',
        'especifica_nivel_2_id',
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

    public function tarea(): BelongsTo
    {
        return $this->belongsTo('App\Models\Tarea', 'tarea_id', 'id');
    }

    public function especificanivel2(): BelongsTo
    {
        return $this->belongsTo('App\Models\EspecificaNivel2', 'especifica_nivel_2_id', 'id');
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo('App\Models\Responsable', 'responsable_id', 'id');
    }
}
