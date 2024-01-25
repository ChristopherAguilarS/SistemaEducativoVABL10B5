<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubGenericaNivel1 extends Model
{
    
    protected $table = 'sub_genericas_nivel_1';
    use HasFactory;
    protected $fillable = [
        'generica_id',
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

    public function generica(): BelongsTo
    {
        return $this->belongsTo('App\Models\Generica', 'generica_id', 'id');
    }
}
