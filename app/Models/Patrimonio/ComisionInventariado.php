<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComisionInventariado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_comision_inventariado';
    protected $primaryKey = 'id';
    protected $fillable=[
        'anio',
        'tipo',
        'personaDni',
        'personaNombres',
        'created_by',
        'created_at'
    ];
}
