<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FinancieroContable\CatalogoCategoriaAlmacen;
class Almacen extends Authenticatable {
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_almacenes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'nombre',
        'estado',
        'responsable_id',
        'categoria_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public function categoria(){
        return $this->belongsTo(CatalogoCategoriaAlmacen::class, 'categoria_id','id');
    }
}
