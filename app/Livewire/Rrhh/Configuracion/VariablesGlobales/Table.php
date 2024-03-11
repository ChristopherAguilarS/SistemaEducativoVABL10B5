<?php

namespace App\Http\Livewire\Rrhh\Configuracion\VariablesGlobales;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\rrhh\VariableGlobal;
class Table extends Component {
    use WithPagination;
    protected $listeners = ['renderizar', 'rtabla'];
    public $estado = 2, $perPage = 20, $monto1;
    public function renderizar(){
        $this->render();
    }
    public function rtabla($estado){
        $this->estado = $estado;
    }
    public function render(){
        $data = VariableGlobal::find(1);       
       $this->monto1 = $data->asignacion_familiar;
       return view('livewire.rrhh.configuracion.variables-globales.table');
    }
}
