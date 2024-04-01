<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CatalogoFormaPago extends Authenticatable {
    public $timestamps = false;
    protected $table='log_catalogo_forma_pago';
    protected $primaryKey = 'id';
    protected $fillable=[
        'descripcion',
        'tipo',
        'dias',
        'estado',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
