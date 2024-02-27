<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovimientoCajaChica extends Model
{
    use HasFactory;
    protected $fillable = [
        'comprobante',
        'fecha',
        'cuenta_id',
        'descripcion',
        'categoria_id',
        'descripcion_categoria',
        'tipo',
        'monto',
        'estado',
        'created_by',
        'updated_by'
    ];

    protected function nTipo(): Attribute
    {
        $resultado = null;
        if($this->tipo == 1){
            $resultado =  'Ingreso';
        }
        else{
            $resultado = 'Egreso';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_id', 'id');
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