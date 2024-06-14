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
        'caja_chica_id',
        'descripcion',
        'fecha',
        'tipo_movimiento',        
        'categoria_movimiento_id',
        'monto',
        'indicador_id',        
        'responsable_id',
        'tipo_desembolso',
        'nro_desembolso',
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

    public function caja_chica(): BelongsTo
    {
        return $this->belongsTo('App\Models\CajaChica', 'caja_chica_id', 'id');
    }
}
