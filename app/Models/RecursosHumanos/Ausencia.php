<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ausencia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_ausencias';
    protected $primaryKey = 'id';
    protected $fillable=[
        'tipo',
        'dias',
        'inicio',
        'fin',
        'vinculoLaboral_id',
        'periodo',
        'motivoAusencia_id',
        'lugar',
        'motivo',
        'observaciones',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
   
}
