<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EspecificaNivel2 extends Model
{
    protected $table = 'especificas_nivel_2';
    use HasFactory;
    protected $fillable = [
        'especifica_nivel_1_id',
        'descripcion',
        'codigo',
        'estado',
        'created_by',
        'updated_by'
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

    public function especificanivel1(): BelongsTo
    {
        return $this->belongsTo('App\Models\EspecificaNivel1', 'especifica_nivel_1_id', 'id');
    }
}
