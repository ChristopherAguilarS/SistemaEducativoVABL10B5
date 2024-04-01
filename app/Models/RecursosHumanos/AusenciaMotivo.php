<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AusenciaMotivo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_ausencias_motivos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'tipoAusencia_id',
        'descripcion',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
   
}
