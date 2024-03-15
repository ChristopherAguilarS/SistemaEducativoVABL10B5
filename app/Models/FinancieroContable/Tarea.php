<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FinancieroContable\CatalogoCategoriaAlmacen;
class Tarea extends Authenticatable {
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='tareas';
    protected $primaryKey = 'id';
    protected $fillable=[
        'indicador_id',
        'codigo',
        'descripcion',
        'comprobante',
        'fecha_pago',
        'bienes_servicios',
        'area_id',
        'responsables',
        'fecha_inicio',
        'fecha_fin',
        'fuente_financiamiento',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
    public function categoria(){
        return $this->belongsTo(CatalogoCategoriaAlmacen::class, 'categoria_id','id');
    }
}
