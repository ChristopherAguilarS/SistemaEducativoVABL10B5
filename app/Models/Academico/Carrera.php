<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'academico_carreras';
    protected $fillable = [
        'id',
        'nombre',
        'estado',
        'created_by',
        'updated_by'
    ];
}
