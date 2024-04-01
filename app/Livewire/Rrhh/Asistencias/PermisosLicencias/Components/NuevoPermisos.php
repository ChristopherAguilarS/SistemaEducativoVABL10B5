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
class NuevoPermisos extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo = "Nuevo Permiso", $tipo = 0, $state, $motivo, $fecha, $inicio, $fin, $idPers, $motivos, $existe = false, $archivo, $documento, $nombres, $observaciones;
    #[On('nuevoPermisos')]
    public function nuevoPermisos($id = 0){
        $this->state = ['tipo' => 0, 'motivo' => 0, 'fecha' => date('Y-m-d'), 'inicio' => date('H:i'), 'fin' => date('H:i'), 'observaciones' => ''];
        $this->nombres = '';
        $this->periodos = null;
        $this->documento = '';
        $this->n_dia = 1;
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
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
                $archivo = 'legajos/'.$this->idPers.'/permisos.pdf';
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
        $this->validate(['fecha' => 'required', 'inicio' => 'required', 'fin' => 'required', 'tipo' => 'required', 'motivo' => 'required|not_in:0']);
        try {
            $this->state = [
                'vinculoLaboral_id' => $this->idPers,
                'tipo' => 2, 
                'dias' =>1,
                'motivoAusencia_id' => $this->motivo, 
                'fecha' => $this->fecha, 
                'inicio' => $this->fecha.' '.$this->inicio, 
                'fin' => $this->fecha.' '.$this->fin, 
                'observaciones' => $this->observaciones,
                'created_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i')
            ];
            $insertado = Ausencia::create($this->state);
                    
            if($insertado){
                $this->dispatch('alert_info', ['mensaje' => 'Permiso guardado correctamente']); 
            }
            if ($this->archivo) {
                if($this->existe && !$this->reemplaza){
                    $rutaTemporalA = $this->archivo->store('temp', 'public');
                    $pdfMerge = new PdfMerge();
                    $pdfMerge->add(Storage::disk('public')->path($rutaTemporalA));
                    $pdfPathB = public_path('legajos/'.$this->idPers.'/permisos.pdf');
                    $pdfMerge->add($pdfPathB);
                    $pdfMerge->merge(public_path('legajos/'.$this->idPers.'/permisos.pdf'));
                    Storage::disk('public')->delete($rutaTemporalA);
                }else{
                    $file = $this->archivo->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = 'permisos.'.$extension;
                    $this->archivo->storeAs('legajos/'.$this->idPers.'/',$nombre, 'public');
                }
            }
            $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        $this->motivos = AusenciaMotivo::where('tipoAusencia_id', 2)->where('pagado', $this->tipo)->get();
        return view('livewire.rrhh.asistencias.permisos-licencias.components.nuevo-permisos');
    }
}
