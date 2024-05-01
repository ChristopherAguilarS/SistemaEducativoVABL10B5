<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_catalogo_clases';
    protected $primaryKey = 'id';
    protected $fillable=[
        'grupo',
        'clase',
        'descripcion'
    ];
}
