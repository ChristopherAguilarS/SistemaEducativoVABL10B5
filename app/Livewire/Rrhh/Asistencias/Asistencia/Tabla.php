<?php

namespace App\Http\Livewire\Rrhh\Asistencias\Asistencia;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Rrhh\VinculoLaboral;
use App\Models\Rrhh\Marcacion;
use App\Models\Rrhh\Ausencia;
use App\Models\Rrhh\ProgramacionAutomatica;
use App\Models\Administracion\Local;
use DB;
class Tabla extends Component
{
    use WithPagination;
    protected $listeners = ['resetTabla'];
    public $perPage = 20;
    public $resetFiltros = 0, $inicio, $fin, $local, $tipo, $anio, $mes, $semana, $semanas, $selectPersona, $tolerancia = 5, $falta = 5, $personas, $ausencias, $posTotal, $marcaciones, $data_pers;
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

       $this->posTotal = $nSemanas;
       $semanas = [];
       $finicio = $inicio;
       $ffin = '';

       $semm='';
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
   public function resetFiltros(){
       $this->resetFiltros = 0 ;
   }
   public function resetTabla($personas, $lugar, $anio, $mes, $estado, $tipo){
       $this->resetFiltros = 1;
       $this->tipo = $tipo;
       $this->anio = $anio;
       $this->mes = $mes;
       $this->semana = 1;
       $this->semanas = $this->proc_semana();
       $this->selectPersona = $personas;
       $this->local = $lugar;
       if($lugar){
            $data = Local::find($lugar);
            $this->tolerancia = $data->tardanza;
            $this->falta = $data->falta;
       }
   }
   public function mount(){
        $this->tolerancia = 10;
        $this->falta = 30;
   }
   public function render() {
       if ($this->resetFiltros) {
            $this->personas =VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', '=', 'p.id')
                ->join('rrhh_catalogo_tipo as ct', 'ct.id', 'rrhh_vinculo_laboral.catalogoTipo_id')
               ->select(DB::raw("CONCAT(p.apellidoPaterno,' ', p.apellidoMaterno, ', ', p.nombres) AS nom"),'numeroDocumento as numero', "p.id as persona", "rrhh_vinculo_laboral.id", "rrhh_vinculo_laboral.id as idv", 'ct.nombre as tipo', 'ct.color')
               ->where("rrhh_vinculo_laboral.estado", 1)
               ->orderby('nom', 'asc');
               
            $this->ausencias=Ausencia::join("rrhh_vinculo_laboral as vl", "vl.id","rrhh_ausencias.vinculoLaboral_id")
                   ->join("rrhh_ausencias_motivos as ma","ma.id","rrhh_ausencias.motivoAusencia_id")
                   ->join("rrhh_ausencia_tipo as ta","ta.id","ma.tipoAusencia_id")
                   ->select("inicio as Inicio", "color", "fin as Fin", "motivoAusencia_id", "ma.id", "ma.descripcion", "vl.persona_id as persona", "vl.id as idv")
                   ->whereRaw("vl.estado=1 and ('".$this->inicio."' BETWEEN rrhh_ausencias.inicio and rrhh_ausencias.fin OR '".$this->fin."' BETWEEN rrhh_ausencias.inicio and rrhh_ausencias.fin OR rrhh_ausencias.inicio BETWEEN '".$this->inicio."' and '".$this->fin."' OR rrhh_ausencias.fin BETWEEN '".$this->inicio."' and '".$this->fin."')");

            if ($this->selectPersona) {
                $this->personas = $this->personas->where('p.id', $this->selectPersona);
                $this->ausencias = $this->ausencias->where('vl.persona_id',$this->selectPersona);
            }else{
                $this->personas = $this->personas->where('rrhh_vinculo_laboral.local_id',$this->local);
                $this->ausencias = $this->ausencias->where('vl.local_id', $this->local);
            }
            $this->personas = $this->personas->get();
            $this->ausencias = $this->ausencias->get();
           if ($this->personas) {
               $idpersonas = $this->personas->pluck('numero');
               $this->marcaciones = Marcacion::whereIn('cDni', $idpersonas)->whereBetween('cFecha', [$this->inicio, $this->fin])->get();

               $data_pers = [];
               $c = 0;
               $anioMes = date('Ym',strtotime($this->inicio));
               $Mes = date('m',strtotime($this->inicio));
               $Anio = date('Y',strtotime($this->inicio));

               if ($this->personas->count()>0) {
                   foreach ($this->personas as $persona){
                       $data_pers[$c] = ['nombre' => $persona->nom, 'dni' => $persona->numero, 'tipo' => $persona->tipo, 'color' => $persona->color];

                       if ($this->tipo) {
                           $horario = ProgramacionAutomatica::join('rrhh_programaciones_automaticas_detalle as ra', 'ra.programacionAutomatica_id', 'rrhh_programaciones_automaticas.id')
                            ->join('rrhh_turnos as t','t.id','ra.turno_id')
                            ->join('rrhh_programaciones_personas as pp', 'pp.programacionAutomatica_id', 'rrhh_programaciones_automaticas.id')
                            ->where('persona_id', $persona->persona)
                            ->select('dia as Fecha','horaInicio', 'horaFin', 'abreviatura')
                            ->get();
                       }else{
                           //si se solicita ver el real
                       }

                       $hora = [];
                       for ($i=$this->inicio; $i <= $this->fin; $i = date('Y-m-d', strtotime($i .'+ 1 days'))) {
                            $dia = date('d', strtotime($i));
                            $nom_dia = date('N', strtotime($i));
                            if ($this->tipo) {
                                $tbl = '';
                                $horario2 = $horario->where('Fecha', $nom_dia);

                                $temp_marcaciones = $this->marcaciones->where("cFecha", $i)->where("cDni", $persona->numero);
                                $temp_ausencias= $this->ausencias
                                    ->where('Inicio','<=',$i)->where('Fin','>=',$i)
                                    ->where('idv', $persona->idv)
                                    ->map(function ($item) {
                                        return '<span class="badge badge-secondary"><b>'.$item->descripcion.'</b></span>';
                                    })->toArray();
                               foreach ($horario2 as $value) {
                                    $marc = '';
                                    $in_h = $value->horaInicio;
                                    if($this->tolerancia){
                                        $ttole = date('H:i', strtotime($in_h.'+'.$this->tolerancia.' minute'));
                                    }else{
                                        $ttole = $value->horaInicio;
                                    }
                                    if($this->tolerancia){
                                        $tfalta = date('H:i', strtotime($in_h.'+'.$this->falta.' minute'));
                                    }else{
                                        $tfalta = date('H:i', strtotime($in_h.'+1 minute'));
                                    }
                         
                                   $fn_h = $value->horaFin;
                                   $entrada_inicio = date('H:i', strtotime($in_h.'-30 minute')); //07:30
                                   $entrada_fin = date('H:i', strtotime($in_h.'+30 minute'));// 08:30

                                   $salida_inicio = date('H:i', strtotime($fn_h.'-30 minute')); //07:30
                                   $salida_fin = date('H:i', strtotime($fn_h.'+30 minute'));// 08:30


                                   $m_inicio = $temp_marcaciones->where('cHora', '<=', $entrada_fin)->where('cHora', '>=', $entrada_inicio)->first();
                                   $m_fin = $temp_marcaciones->where('cHora', '<=', $salida_fin)->where('cHora', '>=', $salida_inicio)->first();

                                   //ingreso
                                   if (isset($m_inicio->cHora)) {
                                       $h_actual = $m_inicio->cHora;
                                   }else{
                                       $h_actual = 0;
                                   }
                               
                                   if ($h_actual && $h_actual<$tfalta) {
                                       if ($h_actual>$ttole) {
                                           $ccolor = 'warning';
                                       }else{
                                           $ccolor = 'success';
                                       }
                                       $hor = date('h:i a', strtotime($h_actual));
                                   }else{
                                       $hor = 'Falta';
                                       $ccolor = 'error';
                                   }

                                   $marc .= '<div class="mt-1 whitespace-nowrap badge bg-'.$ccolor.' text-white"><b>'.$hor.'</b></div>';
                                   //salida
                                   if (isset($m_fin->cHora)) {
                                       $hor2 = date('h:i a', strtotime($m_fin->cHora));
                                       $ccolor2 = 'success';
                                   }else{
                                       $hor2 = 'Falta';
                                       $ccolor2 = 'error';
                                   }
                                   $marc .= '<div class="mt-1 whitespace-nowrap badge bg-'.$ccolor2.' text-white"><b>'.$hor2.'</b></div>';
                                   $tbl .='<tr>
                                           <td  style="vertical-align:middle; padding: 0px 10px; border-right: 1px solid">
                                               <b>'.strtoupper($value->abreviatura).'</b>
                                           </td>
                                           <td>'.$marc.'</td>
                                       </tr>';
                               }
                               if ($tbl) {
                                   $z = ['
                                       <table style="min-width: 10px">
                                           '.$tbl.'
                                       </table>
                                   '];
                               }else{
                                   $z = ['<span class="badge badge-success"><b>Descanso</b></span>'];
                                 //  $z = ['Descanso-/success'];
                               }
                               
                               $temp_marcaciones = $z;
                           }else{
                               $temp_marcaciones = $this->marcaciones->where("cFecha", $i)->where("cDni", $persona->numero)->map(function ($item) {
                                    
                                   $value = '<div class="badge bg-success text-white"><b>'.date('h:i a', strtotime($item->cHora)).'</b></div>';
                                   return $value; 
                               })->toArray();
                               if (count($temp_marcaciones)==0) {

                                $temp_ausencias= $this->ausencias->where('Inicio','<=',$i)->where('Fin','>=',$i)->where('persona', $persona->persona)->map(function ($item) {
                                    return '<span class="badge badge-secondary"><b>'.$item->descripcion.'</b></span>';
                                })->toArray();
                       
     
                                if (count($temp_marcaciones)==0) {
                                    $temp_marcaciones = ['<span class="badge badge-light"><b>S/M</b></span>'];
                                }
                            }
                           }
                           
                           $temp_ausencias= $this->ausencias->where('Inicio','<=',$i)->where('Fin','>=',$i)->where('idv', $persona->idv)->map(function ($item) {
                               return '<span class="badge bg-navy-700 text-white" style="background:'.$item->color.'"><b>'.$item->descripcion.'</b></span>';
                           })->toArray();
                           
                           if ($this->tipo == 1 && !$temp_marcaciones && $i<=date('Y-m-d') && !$temp_ausencias) {
                               $temp_marcaciones = ['<span class="badge badge-danger"><b>Falta</b></span>'];
                           }
                           if($this->tipo);
                           $data_pers[$c]["'".$dia."'"] = array_merge($temp_marcaciones, $temp_ausencias);
                       }
                       $c++;           
                   }
               }
               $this->data_pers = $data_pers;
              // dd($this->data_pers);
           }
       }
       return view('livewire.rrhh.asistencias.asistencia.tabla');
    }
}
