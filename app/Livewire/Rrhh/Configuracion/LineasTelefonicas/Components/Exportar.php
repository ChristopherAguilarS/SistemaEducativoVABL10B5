<?php

namespace App\Http\Livewire\Rrhh\Configuracion\LineasTelefonicas\Components;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Exports\Rrhh\Trabajadores\CuadroExport;
use Maatwebsite\Excel\Facades\Excel;
class Exportar extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['exportar' => 'ver'];
    public $showModal = false, $lugar, $tipo, $mes, $anio, $estado, $checks = [];

    public function ver($lugar, $tipo, $mes, $anio, $estado){
        $this->lugar = $lugar;
        $this->tipo = $tipo;
        $this->mes = $mes;
        $this->anio = $anio;
        $this->estado = $estado;
        $this->showModal = true;
    }
    public function descargar(){
        if(count($this->checks)>0){
            return Excel::download(new CuadroExport($this->lugar, $this->tipo, $this->mes, $this->anio, $this->estado, $this->checks), 'Personal '.date('d-m-Y').'.xlsx');
        }else{
            $this->alert('error', 'Debes seleccionar almenos 01 opción');
        }
    }
    public function render() {
        return view('livewire.rrhh.configuracion.lineas-telefonicas.components.exportar');
    }
}
