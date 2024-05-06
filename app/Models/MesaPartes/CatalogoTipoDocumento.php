<?php

namespace App\Models\MesaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoTipoDocumento extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='mesa_catalogo_tipos_documentos';
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
