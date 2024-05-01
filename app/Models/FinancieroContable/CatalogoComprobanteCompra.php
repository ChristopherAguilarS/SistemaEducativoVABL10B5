<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CatalogoComprobanteCompra extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_catalogo_comprobantes_compra';
    protected $primaryKey = 'id';
    protected $fillable=[
        'descripcion',
        'codigo',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
