<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Generica extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_transaccion_id',
        'descripcion',
        'codigo',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function tipo_transaccion(): BelongsTo
    {
        return $this->belongsTo('App\Models\TipoTransaccion', 'tipo_transaccion_id', 'id');
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
