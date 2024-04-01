<?php

namespace App\Models\RecursosHumanos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merito extends Model{
    use HasFactory;
    public $timestamps = false;
    protected $table='rrhh_meritos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'persona_id',
        'catalogo_motivo_id',
        'fecha_emision',
        'observaciones',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
}
