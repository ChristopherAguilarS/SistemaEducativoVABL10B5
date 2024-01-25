<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CajaChica extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'concepto',
        'tipo_registro_id',
        'monto',
        'beneficiario',
        'comprobante',
        'url',
        'cuenta_id',
        'estado',
        'created_by',
        'updated_by'
    ];
    
    public function tipo_registro(): BelongsTo
    {
        return $this->belongsTo('App\Models\TipoRegistro', 'tipo_registro_id', 'id');
    }

    public function cuenta(): BelongsTo
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_id', 'id');
    }
}
