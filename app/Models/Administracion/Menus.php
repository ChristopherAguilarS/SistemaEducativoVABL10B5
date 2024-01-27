<?php

namespace App\Models\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='menu';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'icon',
        'vista',
        'pos',
        'tipo',
        'raiz',
        'color',
        'estado'
    ];
}
