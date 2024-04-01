<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoColegio extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_catalogo_colegios';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'descripcion',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
