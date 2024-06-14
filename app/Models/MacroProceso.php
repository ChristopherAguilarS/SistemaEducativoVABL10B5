<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MacroProceso extends Model
{
    protected $table = 'macro_procesos';
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'tipo_proceso_id',
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

    public function tipo_proceso(): BelongsTo
    {
        return $this->belongsTo('App\Models\TipoProceso', 'tipo_proceso_id', 'id');
    }
}
