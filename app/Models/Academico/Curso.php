<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'academico_cursos';
    protected $fillable = [
        'id',
        'descripcion',
        'estado',
        'created_by',
        'updated_by'
    ];
}
