<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcesoObjetivoEstrategico extends Model
{
    protected $table = 'procesos_objetivo_estrategicos';
    use HasFactory;
    protected $fillable = [
        'proceso_id',
        'objetivo_estrategico_id',
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

    public function proceso(): BelongsTo
    {
        return $this->belongsTo('App\Models\Proceso', 'proceso_id', 'id');
    }

    public function objetivo_estrategico(): BelongsTo
    {
        return $this->belongsTo('App\Models\ProcesoObjetivoEstrategico', 'objetivo_estrategico_id', 'id');
    }
}
