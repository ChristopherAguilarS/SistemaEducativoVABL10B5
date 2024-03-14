<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FinancieroContable\EquipoRotacion;
use App\Models\FinancieroContable\CatalogoEquipo;
use App\Models\FinancieroContable\CatalogoMarca;
class Equipo extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_equipos';
    protected $primaryKey = 'id';
    protected $fillable=[
        'catalogoEquipos_id',
        'categoria_id',
        'compra_id',
        'catalogoColor_id',
        'catalogoMarca_id',
        'catalogoUnidadMedida_id',
        'modelo',
        'estado',
        'numeroSerie',
        'imagen',
        'certificacion',
        'observaciones',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function item(){
        return $this->belongsTo(CatalogoEquipo::class, 'catalogoEquipos_id', 'id')->withDefault([
            'nombre' => 'N/E',
        ]);
    }
    public function marca(){
        return $this->belongsTo(CatalogoMarca::class, 'catalogoMarca_id', 'id')->withDefault([
            'nombre' => 'N/E',
        ]);
    }
    public function rotaciones(){
        return $this->hasMany(EquipoRotacion::class, 'equipo_id', 'id')->where('estado', 1)->where('tipoDestino', 1);
    }
    public function rotacionesCount(){
        return $this->rotaciones->count();
    }
}
