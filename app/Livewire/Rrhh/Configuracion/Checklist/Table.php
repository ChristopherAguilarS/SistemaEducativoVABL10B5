<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Checklist;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
use App\Models\Rrhh\HojaChecklist;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $aprobacion = 0, $estado = 2, $perPage = 20;
    public function renderizar(){
        $this->render();
    }
    public function rtabla($aprobacion, $estado){
        $this->aprobacion = $aprobacion;
        $this->estado = $estado;
    }
    public function render(){
       $data = HojaChecklist::join('rrhh_hoja_aprobaciones as a', 'a.id', 'rrhh_hoja_checklist.aprobacion_id')->select('rrhh_hoja_checklist.id', 'rrhh_hoja_checklist.descripcion', 'a.nombre as area');
        
        if ($this->estado != 2) {
            $data = $data->where('estado', $this->estado);
        }
        if ($this->aprobacion) {
            $data = $data->where('aprobacion_id', $this->aprobacion);
        }
       return view('livewire.rrhh.configuracion.checklist.table',['posts' => $data->orderby('descripcion', 'asc')->paginate($this->perPage)]);
    }
}
