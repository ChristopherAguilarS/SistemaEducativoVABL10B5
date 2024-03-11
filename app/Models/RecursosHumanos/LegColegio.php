<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegColegio extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_leg_colegiaturas';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'catalogo_colegio_id',
        'fecha',
        'numero',
        'persona_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
