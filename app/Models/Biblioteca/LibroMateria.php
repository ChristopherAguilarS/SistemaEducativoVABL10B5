<?php

namespace App\Models\Biblioteca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroMateria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='biblioteca_libros_materias';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'libro_id',
        'catalogo_materia_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function materia(){
        return $this->belongsTo(CatalogoMateria::class, 'catalogo_materia_id');
    }
}
