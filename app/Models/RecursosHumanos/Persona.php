<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_personas';
    protected $primaryKey = 'id';
    protected $fillable=[
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
