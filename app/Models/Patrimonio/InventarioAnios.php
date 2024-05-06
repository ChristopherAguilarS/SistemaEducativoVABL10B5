<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioAnios extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_inventariado_anios';
    protected $primaryKey = 'id';
    protected $fillable=[
        'anio',
        'estado'
    ];
}
