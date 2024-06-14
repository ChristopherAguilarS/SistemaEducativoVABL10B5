<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequerimientoItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'requerimiento_id',
        'cantidad_solicitada',
        'cantidad_aprobada',
        'especificaciones',
        'observaciones',
        'estado',
        'created_by',
        'updated_by'
    ];
    public function item(): BelongsTo
    {
        return $this->belongsTo('App\Models\Item', 'item_id', 'id');
    }
}
