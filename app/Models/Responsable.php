<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Responsable extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'tipo_responsable',
        'responsable_id',
        'responsables_id',
        'estado',
        'created_by',
        'updated_by',
    ];
    
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
    

    public function responsable(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'responsable_id', 'id');
    }

    public function responsables(): BelongsTo
    {
        return $this->belongsTo('App\Models\Area', 'responsables_id', 'id');
    }
}
