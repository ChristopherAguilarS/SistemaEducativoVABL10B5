<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipoPrestamo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_equipos_prestamo';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'equipo_id',
        'created_by',
        'created_at',
    ];
    
}
