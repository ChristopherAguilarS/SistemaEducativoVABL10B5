<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsientoContable extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'fecha',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function detalle_debe(): HasMany
    {
        return $this->hasMany('App\Models\DetalleAsientoContable', 'asiento_id', 'id')->where('tipo',0);
    }

    public function detalle_haber(): HasMany
    {
        return $this->hasMany('App\Models\DetalleAsientoContable', 'asiento_id', 'id')->where('tipo',1);
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
