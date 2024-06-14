<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndicadorPIM extends Model
{
    protected $table = 'indicador_pim_s';
    use HasFactory;
    protected $fillable = [
        'indicador_id',
        'ubicacion_resolucion',
        'resolucion',
        'descripcion',
        'fecha',
        'importe',
        'estado',
        'created_by',
        'updated_by',
    ];
}
