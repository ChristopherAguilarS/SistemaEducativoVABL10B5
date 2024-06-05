<?php

namespace App\Models\Biblioteca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Biblioteca\Libro;
class Carne extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='biblioteca_carnets';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'tipo',
        'documento',
        'nombres',
        'periodo',
        'etiqueta',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function libros() {
        return $this->hasMany(Libro::class, 'catalogo_autor_id'); // Asegúrate de que 'autor_id' es la clave foránea correcta
    }
}
