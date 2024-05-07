<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoCondicion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_catalogo_condiciones';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'descripcion',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
}