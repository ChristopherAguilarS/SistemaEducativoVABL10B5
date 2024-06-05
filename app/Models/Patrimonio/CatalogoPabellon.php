<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoPabellon extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_catalogo_pabellones';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'descripcion',
        'numero_pisos',
        'area',
        'area_techada',
        'anio_construccion',
        'estado_conservacion',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
}
