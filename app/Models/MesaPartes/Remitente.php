<?php

namespace App\Models\MesaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remitente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='mesa_remitentes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'tipo_remitente',
        'documento',
        'nombres',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
}
