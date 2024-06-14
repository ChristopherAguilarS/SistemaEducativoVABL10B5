<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoCicloAcademico extends Model
{
    use HasFactory;
    protected $fillable = [
        'ciclo_id',
        'curso_id',        
        'programa_estudio_id',
        'turno',
        'seccion',
        'curso_equivalencia_id',
        'docente_id',
        'estado',
        'created_by',
        'updated_by'
    ];
}
