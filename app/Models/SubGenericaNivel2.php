<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubGenericaNivel2 extends Model
{
    protected $table = 'sub_genericas_nivel_2';
    use HasFactory;
    protected $fillable = [
        'sub_generica_nivel_1_id',
        'descripcion',
        'codigo',
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

    public function subgenericanivel1(): BelongsTo
    {
        return $this->belongsTo('App\Models\SubGenericaNivel1', 'sub_generica_nivel_1_id', 'id');
    }
}
