<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class IngresoTemp extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $table='log_ingresos_temp';
    protected $primaryKey = 'id';
    protected $fillable=[
        'compra_id',
        'tipo_movimiento',
        'created_by',
        'created_at'
    ];
}