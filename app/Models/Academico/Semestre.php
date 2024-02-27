<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;
    protected $table = 'academico_semestres';
    protected $fillable = [
        'id',
        'nombre',
        'estado',
        'created_by',
        'updated_by'
    ];
}
