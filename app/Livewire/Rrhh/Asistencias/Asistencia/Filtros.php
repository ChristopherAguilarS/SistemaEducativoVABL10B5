<?php

namespace App\Http\Livewire\Rrhh\Asistencias\Asistencia;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\Rrhh\AsistenciaExport;
use App\Models\Administracion\Local;
use App\Models\Rrhh\Persona;
use App\Models\Rrhh\Marcacion;
use App\Http\Controllers\Controller;
use DB;
use Rats\Zkteco\Lib\ZKTeco;
class Filtros extends Component
{
    use LivewireAlert;
    public $personas, $pers = 0, $anio, $mes, $selectLugar = 0, $locales, $estado = 1, $tipo = 0, $persona = 0;

    public function buscar(){
        $this->emit('resetTabla', $this->persona,$this->selectLugar ,$this->anio, $this->mes,$this->estado, $this->tipo);
    }
    public function descargar() {
        $this->validate(['selectLugar' => 'required|not_in:0']);
        return Excel::download(new AsistenciaExport($this->persona,$this->selectLugar ,$this->anio, $this->mes,$this->estado, $this->tipo), 'Asistencia '.date('d-m-Y').'.xlsx');
    }
    public function procesar(){
        $zk = new ZKTeco('100.100.10.20');
        $zk->connect();
        $mark = $zk->getAttendance();
        $c = 0;
        try{
            foreach ($mark as $data) {
                $c++;
                $dni = $data["id"];
                $fecha = date("Y-m-d", strtotime($data["timestamp"]));
                $hora = date("H:i", strtotime($data["timestamp"]));
                $sav = Marcacion::firstOrCreate(['cDni' => $dni, 'cHora' => $hora, 'cFecha' => $fecha], ['cDni' => $dni, 'cHora' => $hora, 'cFecha' => $fecha]);
            }
            $this->alert('success', 'Se descargaron '.$c.' registros.');
            $zk->clearAttendance();
        }catch(\Exception $e){
             $this->dispatchBrowserEvent(
                'alert', ['type' => 'error',  'message' => 'Ocurrio un error inesperado.']);
        }
        $zk->disconnect(); 
    }
    public function mount(){
        $this->mes = date('m');
        $this->anio = date('Y');
    }
    public function render() {
        $obj = new Controller();
        $this->locales=$obj->verLocalesProyectos(2);
        $this->personas = Persona::join('rrhh_vinculo_laboral as vl', 'rrhh_personas.id', 'vl.persona_id')
            ->join('rrhh_vinculo_detalle as dv', 'dv.vinculoLaboral_id', 'vl.id')
            ->select("rrhh_personas.id", \DB::raw("CONCAT(apellidoPaterno,' ', apellidoMaterno,', ', nombres) as nombres"))
            ->where('vl.estado', $this->estado)
            ->where('local_id', $this->selectLugar)
            ->orderby('nombres', 'asc')
            ->get();

        return view('livewire.rrhh.asistencias.asistencia.filtros');
    }
}
