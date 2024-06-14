<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

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

    public function unidad_medida(): BelongsTo
    {
        return $this->belongsTo('App\Models\UnidadMedida', 'unidad_medida_id', 'id');
    }

    public function familia(): BelongsTo
    {
        return $this->belongsTo('App\Models\FamiliaAdquisicion', 'familia_adquisicion_id', 'id');
    }
}
