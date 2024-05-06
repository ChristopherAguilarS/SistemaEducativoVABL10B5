<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RecursosHumanos\Persona;
class EquipoInventario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_equipos_inventariados';
    protected $primaryKey = 'id';
    protected $fillable=[
        'equipo_id',
        'origen_id',
        'persona_id',
        'estado',
        'anio',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];
    public function persona(){
        return $this->belongsTo(Persona::class, 'persona_id')
            ->withDefault([
                'persona_id' => 'N/E',
            ]);
    }
    public function getTrabAttribute(){
        if(isset($this->persona->nombres)){
            return $this->persona->apellidoPaterno . ' ' . $this->persona->apellidoMaterno. ' ' . $this->persona->nombres;
        }else{
            return null;
        }
    }
    protected $hidden = [
        'created_by',
        'created_at'
    ];
}
