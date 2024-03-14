<?php

namespace App\Models\FinancieroContable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FinancieroContable\Equipo;
use App\Models\RecursosHumanos\Persona;
class EquipoRotacion extends Authenticatable {
    use HasFactory, Notifiable;
    public $timestamps = false;
    protected $table='log_equipos_rotaciones';
    protected $primaryKey = 'id';
    protected $fillable=[
        'equipo_id',
        'pedido_id',
        'origen_id',
        'destino_id',
        'estado',
        'autoriza_id',
        'fechaRotacion',
        'tipoOrigen',
        'tipoDestino',
        'columna',
        'nivel',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public function equipo(){
        return $this->belongsTo(Equipo::class, 'equipo_id', 'id');
    }
    public function autoriza(){
        return $this->belongsTo(Persona::class, 'autoriza_id', 'id');
    }
    public function nombreAutoriza(){
        if(isset($this->autoriza->nombres)){
            return $this->autoriza->nombres . ' ' . $this->autoriza->apellidoPaterno. ' ' . $this->autoriza->apellidoMaterno;
        }else{
            return '';
        }
        
    }
}
