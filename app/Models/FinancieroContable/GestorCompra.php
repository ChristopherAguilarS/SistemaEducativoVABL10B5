<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GestorCompra extends Authenticatable {
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_gestores_compras';
    protected $primaryKey = 'id';
    protected $fillable=[
        'persona_id',
        'proyecto_id',
        'estado',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}