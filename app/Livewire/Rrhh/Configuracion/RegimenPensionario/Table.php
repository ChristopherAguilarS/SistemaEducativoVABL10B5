<?php

namespace App\Http\Livewire\Rrhh\Configuracion\RegimenPensionario;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
use App\Models\Rrhh\RegimenPensionario;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $estado = 2, $perPage = 20;
    public function renderizar(){
        $this->render();
    }
    public function rtabla($estado){
        $this->estado = $estado;
    }
    public function render(){
        $data = RegimenPensionario::query();       
        if ($this->estado != 2) {
            $data = $data->where('estado', $this->estado);
        }
       return view('livewire.rrhh.configuracion.regimen-pensionario.table',['posts' => $data->orderby('nombre', 'asc')->paginate($this->perPage)]);
    }
}
