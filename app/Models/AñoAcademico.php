<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AñoAcademico extends Model
{
    use HasFactory;
    protected $fillable = [
        'año',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'condicion',
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
}
