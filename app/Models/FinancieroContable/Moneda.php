<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_catalogo_monedas';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'simbolo',
        'estado',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
   
}
