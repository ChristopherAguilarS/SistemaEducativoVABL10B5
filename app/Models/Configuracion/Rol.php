<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'name',
        'modulo_id',
        'guard_name',
        'estado',
        'created_by',
        'created_at'
    ];
}
