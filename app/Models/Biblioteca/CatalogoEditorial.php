<?php

namespace App\Models\Biblioteca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoEditorial extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='biblioteca_catalogo_editoriales';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'descripcion',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
}
