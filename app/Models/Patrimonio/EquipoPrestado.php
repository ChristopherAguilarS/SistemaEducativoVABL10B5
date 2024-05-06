<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoPrestado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_equipos_prestados';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'equipo_id',
        'persona_id',
        'fecha_devolucion',
        'estado',
        'created_by',
        'created_at',
    ];
    
}
