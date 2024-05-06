<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_ambientes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'nombre',
        'descripcion',
        'catalogo_tipo_ambiente_id',
        'catalogo_ubicacion_id',
        'catalogo_uso_ambiente_id',
        'catalogo_condicion_id',
        'aforo',
        'area',
        'pabellon',
        'catalogo_piso_id',
        'observaciones',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
}
