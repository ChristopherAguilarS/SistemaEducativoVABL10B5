<?php

namespace App\Livewire\Rrhh\Asistencias\PermisosLicencias\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\Persona;
use App\Models\RecursosHumanos\CatalogoMotivo;
use Carbon\Carbon;
use App\Models\RecursosHumanos\Ausencia;
use DB;
use Livewire\WithFileUploads;
use Karriere\PdfMerge\PdfMerge;
class NuevoVacaciones extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo = "Nuevo", $showModal = false, $anios, $periodo, $periodos, $documento, $nombres, $state = ['inicio' => null, 'fin' => null], $n_dia = 1, $idPers, $existe = false, $archivo;
    #[On('nuevoVacaciones')]
    public function nuevoVacaciones($id = 0){
        $this->state = ['inicio' => date('Y-m-d'), 'fin' => date('Y-m-d'), 'periodo' => 0, 'observaciones' => ''];
        $this->nombres = '';
        $this->periodos = null;
        $this->documento = '';
        $this->n_dia = 1;
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    public function buscar(){
        $this->idPers = 0;
        $data = Persona::leftjoin('rrhh_vinculo_laboral as vl', 'vl.persona_id', 'rrhh_personas.id')
            ->select('vl.id', 'rrhh_personas.apellidoPaterno', 'rrhh_personas.apellidoMaterno', 'rrhh_personas.nombres', 'vl.estado', 'vl.fecha_inicio as fecha')
            ->where('numeroDocumento', $this->documento)->first();
        if($data){
            if($data->estado == 1){
                $this->nombres = $data->apellidoPaterno.' '.$data->apellidoMaterno.', '.$data->nombres;
                $this->idPers = $data->id;
                $c=0;
                for ($i = date('Y',strtotime($data->fecha)); $i <= date('Y'); $i++) {
                    $this->anios[$c]=$i;
                    $c++;
                    $vacaciones=Ausencia::select(DB::raw("sum(dias) as total"))
                        ->where('vinculoLaboral_id', $data->id)
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
                        $currentDate = Carbon::createFromFormat('Y-m-d', date($i.'-m-d',strtotime($data->fecha)));
                        $shippingDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                        $interval = $currentDate->diffInDays($shippingDate);

                        $disponibles= number_format(($interval+1)*0.0833333333333333,1);
                        $this->periodos[$i]=array($i,date('d/m/'.$i,strtotime($data->fecha)),date('d/m/Y'),$tomadas,$disponibles);
                    }else{
                        $this->periodos[$i]=array($i,date('d/m/'.$i,strtotime($data->fecha)),date('d/m/'.($i+1),strtotime('+1 year '.$data->fecha)),$tomadas,$disponibles);
                    }
                }
                $archivo = 'legajos/'.$this->idPers.'/vacaciones.pdf';
                $rutaCompleta = public_path($archivo);
                if (file_exists($rutaCompleta)) {
                    $this->existe = true;
                } else {
                    $this->existe = false;
                }
                $this->dispatch('alert_info', ['mensaje' => 'Trabajador Encontrado']);
            }else{
                $this->dispatch('alert_danger', ['mensaje' => 'Trabaja no tiene un contrato vigente']);
            }
        }else{
            $this->nombres = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Trabajador no Encontrado']);
        }
    }
    public function guardar(){
        $this->validate(['state.inicio' => 'required', 'state.fin' => 'required', 'state.periodo' => 'required|not_in:0']);
        try {
            $dias = (strtotime($this->state['inicio'])-strtotime($this->state['fin']))/86400;
            $dias = abs($dias); 
            $dias = floor($dias)+1;
            if ($this->periodo==0) {
                $this->dispatch('alert_danger', ['mensaje' => 'Seleccione un trabajador válido.']);
            }else{
                $tt=Ausencia::select(DB::raw("sum(dias) as total"))
                    ->where('vinculoLaboral_id','=', $this->idPers)
                    ->where('periodo','=',$this->periodo)
                    ->where('motivoAusencia_id','=',1)->first();
                
                $res=30-$tt->total;

                if (intval($res)<intval($dias)) {
                    $this->dispatch('alert_danger', ['mensaje' => 'Los dias programados exceden a los disponibles.']);
                }else{
                    $this->state['tipo'] = 1;
                    $this->state['dias'] = $dias;
                    $this->state['motivoAusencia_id'] = 1;
                    $this->state['vinculoLaboral_id'] = $this->idPers;
                    $this->state['created_by'] = auth()->user()->id;
                    $this->state['created_at'] = date('Y-m-d H:i');
                    $insertado = Ausencia::create($this->state);
                    
                    if($insertado){
                        $this->dispatch('alert_info', ['mensaje' => 'Vacaciones guardadas correctamente']);
                        $this->showModal = false;
                    }
                }
                if ($this->archivo) {
                    if($this->existe && !$this->reemplaza){
                        $rutaTemporalA = $this->archivo->store('temp', 'public');
                        $pdfMerge = new PdfMerge();
                        $pdfMerge->add(Storage::disk('public')->path($rutaTemporalA));
                        $pdfPathB = public_path('legajos/'.$this->idPers.'/vacaciones.pdf');
                        $pdfMerge->add($pdfPathB);
                        $pdfMerge->merge(public_path('legajos/'.$this->idPers.'/vacaciones.pdf'));
                        Storage::disk('public')->delete($rutaTemporalA);
                    }else{
                        $file = $this->archivo->getClientOriginalName();
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                        $nombre = 'vacaciones.'.$extension;
                        $this->archivo->storeAs('legajos/'.$this->idPers.'/',$nombre, 'public');
                    }
                }
            }
            
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        $this->motivos = CatalogoMotivo::where('estado', 1)->where('tipo', 1)->get();
        return view('livewire.rrhh.asistencias.permisos-licencias.components.nuevo-vacaciones');
    }
}
