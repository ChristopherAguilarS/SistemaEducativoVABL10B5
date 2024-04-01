<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoCondicion extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_catalogo_condiciones';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'descripcion',
        'catalogo_regimen_id',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
