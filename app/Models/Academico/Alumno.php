<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'academico_alumnos';
    protected $fillable = [
        'id',
        'apellidoPaterno',
        'apellidoMaterno',
        'nombres',
        'tipoDocumento',
        'numeroDocumento',
        'sexo',
        'fechaNacimiento',
        'estado',
        'estadoCivil',
        'email',
        'direccion',
        'lugar_nacimiento',
        'telefonos',
        'imagen',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
