<?php

namespace App\Http\Livewire\Rrhh\Asistencias\PermisosLicencias\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Models\Rrhh\Ausencia;
use App\Models\Rrhh\Persona;
use App\Models\Rrhh\VinculoLaboral;
use Carbon\Carbon;
class NuevoVacaciones extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['nuevoVacacion' => 'nuevo'];
    public $titulo, $showModal = false, $anios, $periodo, $periodos, $documento, $nombres, $state, $n_dia = 1;

    public function nuevo(){
        $this->state = ['inicio' => date('Y-m-d'), 'fin' => date('Y-m-d'), 'periodo' => 0, 'observaciones' => ''];
        $this->nombres = '';
        $this->documento = '';
        $this->n_dia = 1;
        $this->showModal = true;
    }
    public function buscar(){
        $pers = Persona::where('numeroDocumento', $this->documento)->first();
        if($pers){
            $contrato = VinculoLaboral::where('estado', 1)->where('persona_id', $pers->id)->first();
            if($contrato){
                $this->nombres = $pers->apellidoPaterno.' '.$pers->apellidoPaterno.', '.$pers->nombres;
                $this->state['vinculoLaboral_id'] = $contrato->id;
                $c=0;
                for ($i = date('Y',strtotime($contrato->fecha)); $i <= date('Y'); $i++) {
                    $this->anios[$c]=$i;
                    $c++;
                    $vacaciones=Ausencia::select(DB::raw("sum(dias) as total"))
                        ->where('vinculoLaboral_id', $contrato->id)
                        ->where('periodo', $i)
                        ->where('motivoAusencia_id', 1)->first();  

                    $tomadas=$vacaciones->total;
                    $disponibles=30-$vacaciones->total;

                    if ($i>=date("Y",strtotime(date('Y')."- 2 year"))) { 
                        if($disponibles>0){
                            if(!$this->periodo){$this->periodo=$i;}
                        }
                    }
                    
                    if($i==date('Y')){
                        $currentDate = Carbon::createFromFormat('Y-m-d', date($i.'-m-d',strtotime($contrato->fecha)));
                        $shippingDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                        $interval = $currentDate->diffInDays($shippingDate);

                        $disponibles= number_format(($interval+1)*0.0833333333333333,1);
                        $this->periodos[$i]=array($i,date('d/m/'.$i,strtotime($contrato->fecha)),date('d/m/Y'),$tomadas,$disponibles);
                    }else{
                        $this->periodos[$i]=array($i,date('d/m/'.$i,strtotime($contrato->fecha)),date('d/m/'.($i+1),strtotime('+1 year '.$contrato->fecha)),$tomadas,$disponibles);
                    }
                }
            }else{
                $this->alert('error', 'El D.N.I. '.$this->documento.', no tiene contrato activo.');
            }
        }else{
            $this->nombres = '';
            $this->state['persona_id'] = 0;
            $this->alert('error', 'Nro. de documento no existe');
        }
    }
    public function guardar(){
        $validatedData = $this->validate(['state.inicio' => 'required', 'state.fin' => 'required', 'state.periodo' => 'required|not_in:0']);
        $dias = (strtotime($this->state['inicio'])-strtotime($this->state['fin']))/86400;
        $dias = abs($dias); 
        $dias = floor($dias)+1;
        if ($this->periodo==0) {
            $this->alert('error', 'Seleccione un trabajador válido.');
        }else{
            $tt=Ausencia::select(DB::raw("sum(dias) as total"))
                ->where('vinculoLaboral_id','=', $this->state['vinculoLaboral_id'])
                ->where('periodo','=',$this->periodo)
                ->where('motivoAusencia_id','=',1)->first();
            
            $res=30-$tt->total;

            if (intval($res)<intval($dias)) {
                $this->alert('error', 'Los dias programados exceden a los disponibles.');
            }else{
                $this->state['dias'] = $dias;
                $this->state['motivoAusencia_id'] = 1;
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d H:i');
                $insertado = Ausencia::create($this->state);
                
                if($insertado){
                    $this->alert('success', 'Vacaciones guardadas correctamente');
                    $this->showModal = false;
                }
            }
        }
    }
    public function render() {
        return view('livewire.rrhh.asistencias.permisos-licencias.components.nuevo-vacaciones');
    }
}
