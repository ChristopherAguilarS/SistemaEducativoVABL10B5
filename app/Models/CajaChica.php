<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CajaChica extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_creacion',
        'descripcion',
        'decreto',
        'ruta_decreto',
        'responsable_id',
        'año_academico_id',
        'monto_inicial',
        'fuente_financiamiento',
        'comprobante',
        'estado',
        'created_by',
        'updated_by'
    ];

    public function movimientos(): HasMany
    {
        return $this->hasMany('App\Models\MovimientoCajaChica', 'caja_chica_id', 'id');
    }

    public function año_academico(): BelongsTo
    {
        return $this->belongsTo('App\Models\AñoAcademico', 'año_academico_id', 'id');
    }

    protected function nFuenteFinanciamiento(): Attribute
    {
        $resultado = null;
        if($this->fuente_financiamiento == 1){
            $resultado =  'Recursos Directamente Recaudados';
        }
        elseif($this->fuente_financiamiento == 2){
            $resultado =  'Recursos Directamente Recaudados';
        }
        else{
            $resultado = '';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }
    
    protected function nEstado(): Attribute
    {
        $resultado = null;
        if($this->estado == 1){
            $resultado =  'Activo';
        }
        else{
            $resultado = 'Inactivo';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }
}
