<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_catalogo_grupos';
    protected $primaryKey = 'grupo';
    protected $fillable=[
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
