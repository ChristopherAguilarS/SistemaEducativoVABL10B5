<?php

namespace App\Http\Livewire\Rrhh\Configuracion\AprobacionTipo;
use App\Models\Rrhh\HojaAprobacionTipo;
use App\Models\Rrhh\HojaAprobacion;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
use App\Models\Rrhh\Persona;
use App\Models\Rrhh\VinculoLaboral;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $tipo = 0, $estado = 2, $perPage = 20, $tipos = [], $arr = [], $nombres, $pers, $personas;
    public function renderizar(){
        $this->render();
    }
    public function rtabla($tipo){
        $this->arr = [];
        $this->tipo = $tipo;
        
        $data = HojaAprobacionTipo::where('catalogoTipo_id', $this->tipo)
            ->get();
        foreach ($data as $dd) {
                $this->arr[$dd->hojaAprobacion_id] = $dd->hojaAprobacion_id;
        }
    }
    public function guardar(){
        $del = HojaAprobacionTipo::where('catalogoTipo_id', $this->tipo)->delete();
        foreach ($this->arr as $data) {
            if($data){
                $sav = HojaAprobacionTipo::updateorcreate(
                    ['id' => $this->tipo.str_pad($data, 3, "0", STR_PAD_LEFT)],
                    [
                        'catalogoTipo_id' => $this->tipo,
                        'hojaAprobacion_id' => $data,
                        'created_by' => auth()->user()->id,
                        'created_at' => date('Y-m-d')
                    ]
                );
            }
        }
    }
    public function buscar($id){
        $pers = Persona::where('numeroDocumento', $this->documento)->first();
        if($pers){
            $contrato = VinculoLaboral::where('estado', 1)->where('persona_id', $pers->id)->first();
            if($contrato){
                $this->alert('error', 'El D.N.I. '.$this->documento.', tiene contrato activo.');
                $this->nombres = '';
                $this->pers[$id] = 0;
            }else{
                $this->nombres = $pers->apellidoPaterno.' '.$pers->apellidoMaterno.', '.$pers->nombres;
                $this->pers[$id] = $pers->id;
            }
        }else{
            $this->nombres = '';
            $this->pers[$id] = 0;
            $this->alert('error', 'Nro. de documento no existe');
        }
    }
    public function render(){
        if($this->tipo){
            $this->tipos = HojaAprobacion::leftjoin('users as u', 'u.id', 'rrhh_hoja_aprobaciones.persona_id')
                ->join('roles as r','r.id','rrhh_hoja_aprobaciones.rol')
                ->select('rrhh_hoja_aprobaciones.id', 'rrhh_hoja_aprobaciones.nombre', 'rol', 'r.name as nrol')
                ->get();
            $this->personas = Persona::join('users as u', 'u.id', 'rrhh_personas.id')
                ->join('role_user as ru','ru.user_id','u.id')
                
                ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS noms"), 'role_id', 'u.email')
                ->get();
        }
       return view('livewire.rrhh.configuracion.aprobacion-tipo.table');
    }
}