<?php

namespace App\Livewire\Rrhh\Asistencias\PermisosLicencias\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\Persona;
use Livewire\WithFileUploads;
use App\Models\RecursosHumanos\Ausencia;
class Resumen extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $idPers, $tp, $existe = false, $archivo, $nombres, $documento;
    #[On('verResumen')]
    public function verResumen($id, $tp){
        $this->nombres = '';
        $this->documento = '';
        $this->tp = $tp;
        if($tp == 1){
            $this->titulo = "Resumen de Vacaciones";
        }elseif($tp == 2){
            $this->titulo = "Resumen de Permisos";
        }elseif($tp == 3){
            $this->titulo = "Resumen de Licencias";
        }elseif($tp == 4){
            $this->titulo = "Resumen de Comisiones";
        }
        $this->buscar($id, 1);
        $this->dispatch('verModal', ['id' => 'form5', 'accion' => 'show']);
    }
    public function buscar($id, $tp = 2){
        if($tp == 1){
            $busq = 'vl.id';
        }elseif($tp == 2){
            $busq = 'numeroDocumento';
        }
        $data = Persona::leftjoin('rrhh_vinculo_laboral as vl', 'vl.persona_id', 'rrhh_personas.id')
            ->select('vl.id', 'rrhh_personas.numeroDocumento', 'rrhh_personas.apellidoPaterno', 'rrhh_personas.apellidoMaterno', 'rrhh_personas.nombres', 'vl.estado', 'vl.fecha_inicio as fecha')
            ->where($busq, $id)->first();
        if($data){
            if($data->estado == 1){
                if($tp == 1){
                    $busq = 'vl.id';
                    $this->idPers = $id;
                }elseif($tp == 2){
                    $busq = 'numeroDocumento';
                    $this->idPers = $data->id;
                }
                $this->nombres = $data->apellidoPaterno.' '.$data->apellidoMaterno.', '.$data->nombres;
                $this->documento = $data->numeroDocumento;
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
    public function render(){
        $posts = Ausencia::join('rrhh_ausencias_motivos as am', 'am.id', 'rrhh_ausencias.motivoAusencia_id')
            ->select('am.descripcion as motivo', 'pagado', 'inicio', 'fin', 'periodo', 'dias', 'observaciones', 'lugar', 'rrhh_ausencias.motivo as motivos2')
            ->where('vinculoLaboral_id', $this->idPers)
            ->where('tipo', $this->tp)
            ->get();
        return view('livewire.rrhh.asistencias.permisos-licencias.components.resumen', ['posts' => $posts]);
    }
}
