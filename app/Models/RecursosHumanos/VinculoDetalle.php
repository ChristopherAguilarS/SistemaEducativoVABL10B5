<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VinculoDetalle extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_vinculo_detalle';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'tipo_documento_id',
        'vinculo_laboral_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
