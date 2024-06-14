<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Requerimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nro_requerimiento',
        'responsable_id',
        'indicador_id',
        'tipo_pedido',
        'folios',
        'fecha_registro_requerimiento',
        'fecha_aprobacion_requerimiento',
        'descripcion',
        'comentarios',
        'estado_proceso',
        'estado',
        'created_by',
        'updated_by'
    ];

    protected function nTipoPedido(): Attribute
    {
        $resultado = null;
        if($this->tipo_pedido == 1){
            $resultado =  'Bien';
        }
        else{
            $resultado = 'Servicio';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }

    protected function nEstadoProceso(): Attribute
    {
        $resultado = null;
        if($this->estado_proceso == 1){
            $resultado =  'Pendiente';
        }
        else{
            $resultado = 'Aprobado';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }

    protected function nEstadoProcesoPedido(): Attribute
    {
        $resultado = null;
        if($this->estado_proceso == 2){
            $resultado =  'Pendiente';
        }
        else{
            $resultado = 'Generado';
        }
        return Attribute::make(
            get: fn () => $resultado,
        );
    }

    public function indicador(): BelongsTo
    {
        return $this->belongsTo('App\Models\Indicador', 'indicador_id', 'id');
    }

    public function pedido(): HasOne
    {
        return $this->hasOne('App\Models\Pedido','requerimiento_id','id');
    }
}
