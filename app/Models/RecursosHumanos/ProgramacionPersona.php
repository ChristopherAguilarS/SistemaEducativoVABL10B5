<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramacionPersona extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_programaciones_personas';
    protected $primaryKey = 'id';
    protected $fillable=[
        'persona_id',
        'programacionAutomatica_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
   
}
