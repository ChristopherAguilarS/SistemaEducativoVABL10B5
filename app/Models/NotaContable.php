<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotaContable extends Model
{
    use HasFactory;
    protected $table = 'nota_contable';
    protected $fillable = [
        'codigo',
        'fecha',
        'cuenta_debe_id',
        'cuenta_haber_id',
        'monto_debe',
        'monto_haber',
        'descripcion',
        'tipo',
        'estado',
        'created_by',
        'updated_by'
    ];

    protected function nTipo(): Attribute
    {
        $resultado = null;
        if($this->tipo == 1){
            $resultado =  'Deudor';
        }
        else{
            $resultado = 'Acreedor';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }

    public function cuenta_haber(): BelongsTo
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_haber_id', 'id');
    }

    public function cuenta_debe(): BelongsTo
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_debe_id', 'id');
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
