<?php

namespace App\Livewire\Rrhh\Asistencias\PermisosLicencias\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\Persona;
use Livewire\WithFileUploads;
use Karriere\PdfMerge\PdfMerge;
use App\Models\RecursosHumanos\Ausencia;
use App\Models\RecursosHumanos\AusenciaMotivo;
use DB;
class NuevoComisiones extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo = "Nueva Comision", $tipo = 0, $motivo, $fecha_inicio, $fecha_fin, $idPers, $lugar, $existe = false, $archivo, $observaciones, $nombres, $documento;
    #[On('nuevoComisiones')]
    public function nuevoComisiones($id = 0){
        $this->state = [];
        $this->fecha_inicio = date('Y-m-d');
        $this->fecha_fin = date('Y-m-d');
        $this->lugar = '';
        $this->motivo = '';
        $this->observaciones = '';
        $this->nombres = '';
        $this->documento = '';
        $this->dispatch('verModal', ['id' => 'form4', 'accion' => 'show']);
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
                $archivo = 'legajos/'.$this->idPers.'/comisiones.pdf';
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
    public function mount(){
        $this->fecha = date('Y-m-d');
        $this->inicio = date('h:i');
        $this->fin = date('h:i');
    }
    public function guardar(){
        $this->validate(['fecha_inicio' => 'required', 'fecha_fin' => 'required', 'lugar' => 'required', 'motivo' => 'required']);
        try {
            $dias = (strtotime($this->fecha_inicio)-strtotime($this->fecha_fin))/86400;
            $dias = abs($dias); 
            $dias = floor($dias)+1;
            $this->state = [
                'motivoAusencia_id' => 15, 
                'vinculoLaboral_id' => $this->idPers,
                'tipo' => 4, 
                'dias' => $dias,
                'inicio' => $this->fecha_inicio,
                'fin' => $this->fecha_fin,
                'lugar' => $this->lugar,
                'motivo' => $this->motivo,
                'observaciones' => $this->observaciones,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i')
            ];
            $insertado = Ausencia::create($this->state);
                    
            if($insertado){
                $this->dispatch('alert_info', ['mensaje' => 'Comision guardada correctamente']);
                $this->showModal = false;
            }
            if ($this->archivo) {
                if($this->existe && !$this->reemplaza){
                    $rutaTemporalA = $this->archivo->store('temp', 'public');
                    $pdfMerge = new PdfMerge();
                    $pdfMerge->add(Storage::disk('public')->path($rutaTemporalA));
                    $pdfPathB = public_path('legajos/'.$this->idPers.'/comisiones.pdf');
                    $pdfMerge->add($pdfPathB);
                    $pdfMerge->merge(public_path('legajos/'.$this->idPers.'/comisiones.pdf'));
                    Storage::disk('public')->delete($rutaTemporalA);
                }else{
                    $file = $this->archivo->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = 'comisiones.'.$extension;
                    $this->archivo->storeAs('legajos/'.$this->idPers.'/',$nombre, 'public');
                }
            }
            $this->dispatch('verModal', ['id' => 'form4', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        $this->motivos = AusenciaMotivo::where('tipoAusencia_id', 4)->where('pagado', $this->tipo)->get();
        return view('livewire.rrhh.asistencias.permisos-licencias.components.nuevo-comisiones');
    }
}
