<?php

namespace App\Models\Biblioteca;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Biblioteca\CatalogoAutor;
use App\Models\Biblioteca\CatalogoEditorial;
use App\Models\Biblioteca\CatalogoTipoIngreso;
class LibroReserva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='biblioteca_libros_reservas';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'persona_id',
        'libro_id',
        'valoracion',
        'opinion',
        'estado',
        'entrega_by',
        'entrega_observaciones',
        'entrega_at',
        'recojo_by',
        'recojo_observaciones',
        'recojo_at',
        'canceled_by',
        'canceled_at',
        'created_by',
        'created_at'
    ];  
    public function autor(){
        return $this->belongsTo(CatalogoAutor::class, 'catalogo_autor_id');
    }
    public function editorial(){
        return $this->belongsTo(CatalogoEditorial::class, 'catalogo_editorial_id');
    }
    public function ingreso(){
        return $this->belongsTo(CatalogoTipoIngreso::class, 'catalogo_tipo_ingreso_id');
    }
}
