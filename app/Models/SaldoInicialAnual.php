<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaldoInicialAnual extends Model
{
    use HasFactory;
    protected $fillable = [
        'año',
        'cuenta_id',
        'saldo_inicial_debe',
        'saldo_inicial_haber',
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

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_id', 'id');
    }
}
