<?php

namespace App\Models\Biblioteca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Biblioteca\CatalogoAutor;
use App\Models\Biblioteca\CatalogoEditorial;
use App\Models\Biblioteca\CatalogoTipoIngreso;
use App\Models\Biblioteca\LibroMateria;
use App\Models\Biblioteca\CatalogoIdioma;
use App\Models\Biblioteca\CatalogoCategoria;
class Libro extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='biblioteca_libros';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'nombre',
        'descripcion',
        'catalogo_autor_id',
        'catalogo_editorial_id',
        'catalogo_idioma_id',
        'catalogo_tipo_ingreso_id',
        'catalogo_categoria_id',
        'ISBN',
        'anio',
        'valoracion',
        'imagen',
        'reservado_por',
        'estado',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
    public function autor(){
        return $this->belongsTo(CatalogoAutor::class, 'catalogo_autor_id');
    }
    public function editorial(){
        return $this->belongsTo(CatalogoEditorial::class, 'catalogo_editorial_id');
    }
    public function idioma(){
        return $this->belongsTo(CatalogoIdioma::class, 'catalogo_idioma_id');
    }
    public function categoria(){
        return $this->belongsTo(CatalogoCategoria::class, 'catalogo_categoria_id');
    }
    public function ingreso(){
        return $this->belongsTo(CatalogoTipoIngreso::class, 'catalogo_tipo_ingreso_id');
    }
    public function materias(){
        return $this->hasMany(LibroMateria::class, 'libro_id', 'id');
    }
}
