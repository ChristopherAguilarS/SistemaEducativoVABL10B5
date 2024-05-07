<?php

namespace App\Models\MesaPartes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='mesa_expedientes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'catalogo_tipo_documento_id',
        'folios',
        'asunto',
        'tipo_remitente',
        'catalogo_area_id',
        'persona_id',
        'remitente_id',
        'remitente_documento',
        'remitente_nombre',
        'estado',
        'origen_id',
        'observaciones',
        'persona_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
}
