<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $table = 'academico_matriculas';
    protected $fillable = [
        'id',
        'anio_id',
        'carrera_id',
        'ciclo_id',
        'persona_id'.
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
