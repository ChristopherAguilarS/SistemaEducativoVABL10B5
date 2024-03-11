<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoEstudio extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_catalogo_estudios';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'nombre',
        'catalogo_tipo_estudio_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
