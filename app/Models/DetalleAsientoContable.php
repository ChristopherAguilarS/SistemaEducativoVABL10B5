<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAsientoContable extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'asiento_id',
        'cuenta_id',
        'monto',
        'tipo',
        'fecha',
        'estado',
        'created_by',
        'updated_by'
    ];
}
