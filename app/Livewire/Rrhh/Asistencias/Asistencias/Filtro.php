<?php
namespace App\Livewire\Rrhh\Asistencias\Asistencias;
use App\Models\RecursosHumanos\VinculoLaboral;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class Filtro extends Component{
    public $f_tipo, $f_condicion, $f_area, $mes;
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
    public function render(){
        $this->personas = VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', 'p.id')
            ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'numeroDocumento AS dni')
            ->where('rrhh_vinculo_laboral.estado', 1)
            ->get();
        return view('livewire.rrhh.asistencias.asistencias.filtro');
    }
}