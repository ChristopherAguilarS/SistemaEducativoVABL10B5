<?php

namespace App\Models\Equipamiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoEquipo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='equipamiento.CatalogoEquipos';
    protected $fillable=[
        'grupo',
        'clase',
        'familia',
        'item',
        'descripcion'
    ];
    protected $hidden = [
        'IdUsuarioCrea',
        'FechaCrea'
    ];

    public function scopeSearch($query,$val)
    {
        return $query
        ->where('Item','like','%'.$val.'%')
        ->Orwhere('FamiliaBien','like','%'.$val);
        //->Orwhere('fecha','=',$val)
        
    }
    
}
