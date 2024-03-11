<?php

namespace App\Http\Livewire\Rrhh\Asistencias\TareoObra;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Administracion\Local;
use App\Models\Rrhh\Persona;
use App\Exports\Rrhh\TareosExport;
use App\Http\Controllers\Controller;
use DB;

class Filtros extends Component
{
    use LivewireAlert;
    public $personas, $pers = 0, $anio, $mes, $selectLugar = 0, $locales, $tipoTareo = 0, $tipoTrabajador = 1, $estado = 1, $inicio, $fin, $semanas, $semana, $posTotal;

    public function buscar(){
        $this->validate(['selectLugar' => 'required|not_in:0']);
        $this->emit('resetTabla', $this->selectLugar ,$this->inicio,$this->fin, $this->tipoTrabajador, $this->tipoTareo, $this->estado);
    }
    public function configuracion(){

    }
    public function updt(){
        $this->semana = 1;
        $this->semanas = $this->proc_semana();
    }
    public function primerDiaSemana($year, $month, $day){
        // Número de la semana
        $semana=date("W",mktime(0,0,0,$month,$day,$year));
        // Día de la semana de la fecha dada
        $diaSemana=date("w",mktime(0,0,0,$month,$day,$year));
        // 0 es el domingo
        if($diaSemana==0){ $diaSemana=7; }
        // A la fecha recibida, le restamos el dia de la semana y obtendremos el lunes
        $primerDia= date("Y-m-d",mktime(0,0,0,$month,$day-$diaSemana+1,$year));
        return $primerDia;
   }
    private function proc_semana(){
        $fin = date('Y-m-t', strtotime($this->anio.'-'.$this->mes.'-01'));
        $inicio = $this->primerDiaSemana($this->anio, $this->mes, '01');
        if (date('m', strtotime($fin)) == 1) {
                 $nSemanas = 5;
        }else{
            $nSemanas = (date("W", strtotime($fin))-date("W", strtotime($inicio))+1);
        }
 
        $semanas = [];
        $finicio = $inicio;
        $ffin = '';
 
        for ($i= 1; $i <= $nSemanas; $i++) {
            $ffin = date('Y-m-d', strtotime($finicio.'+ 6 days'));
 
            if ($i==1) {
                $this->inicio = $this->anio.'-'.$this->mes.'-01';
                $this->fin = $ffin;
                $v_inicio = $this->anio.'-'.$this->mes.'-01';
                $v_fin = $ffin;
            }elseif($i==$nSemanas){
                $v_inicio = $finicio;
                $v_fin = $fin;
            }else{
                $v_inicio = $finicio;
                $v_fin = $ffin;
            }
            
            if ($v_inicio <= date('Y-m-d') && $v_fin >=date('Y-m-d')) {
                $this->inicio = $v_inicio;
                $this->fin = $v_fin;
                $this->semana = $i;
            }
 
            $semanas[$i] = ['inicio' => $v_inicio,'fin'=>$v_fin];
            $finicio = date('Y-m-d', strtotime($ffin.'+ 1 days'));
        }
        return $semanas;
    }
    public function updatedsemana($id){
        $this->inicio = $this->semanas[$id]['inicio'];
        $this->fin = $this->semanas[$id]['fin'];
       // dd($this->inicio.'--'.$this->fin);
    }
    public function masSem(){
        if ($this->posTotal >=($this->semana +1)) {
            $this->semana= $this->semana +1;
            $this->updatedsemana($this->semana);
        }
    }
    public function menSem(){
        if (0<($this->semana -1)) {
            $this->semana= $this->semana -1;
 
            $this->updatedsemana($this->semana);
        }
    }
    public function descargar() {
        $this->validate(['selectLugar' => 'required|not_in:0']);
        return Excel::download(new TareosExport($this->selectLugar ,$this->inicio,$this->fin, $this->tipoTrabajador, $this->tipoTareo, $this->estado), 'Tareos '.date('d-m-Y').'.xlsx');
    }
    public function mount(){
        $this->mes = date('m');
        $this->anio = date('Y');
        $this->semana = 1;
        $this->semanas = $this->proc_semana();
        $obj = new Controller();
        $this->locales=$obj->verLocalesProyectos(2);
        $this->locales = $this->locales->toArray();
    }
    public function render() {
        $this->personas = Persona::join('rrhh_vinculo_laboral as vl', 'rrhh_personas.id', 'vl.persona_id')
            ->join('rrhh_vinculo_detalle as dv', 'dv.vinculoLaboral_id', 'vl.id')
            ->select("rrhh_personas.id", \DB::raw("CONCAT(apellidoPaterno,' ', apellidoMaterno,', ', nombres) as nombres"))
            ->where('vl.estado', $this->estado)
            ->where('local_id', $this->selectLugar)
            ->orderby('nombres', 'asc')
            ->get();

        return view('livewire.rrhh.asistencias.tareo-obra.filtros');
    }
}
