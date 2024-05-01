<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_catalogo_familias';
    protected $primaryKey = 'id';
    protected $fillable=[
        'grupo',
        'clase',
        'familia',
        'denominacion',
        'imagen'
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
