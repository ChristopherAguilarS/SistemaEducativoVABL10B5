<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proceso extends Model
{
    protected $table = 'procesos';
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'macro_proceso_id',
        'macro_proceso_estado',
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

    public function macro_proceso(): BelongsTo
    {
        return $this->belongsTo('App\Models\MacroProceso', 'macro_proceso_id', 'id');
    }
}
