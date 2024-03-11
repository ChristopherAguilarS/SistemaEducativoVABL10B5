<?php
namespace App\Http\Livewire\Rrhh\Asistencias\PermisosLicencias\Components;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use DB;
use App\Models\Rrhh\Ausencia;
use App\Models\Rrhh\VinculoLaboral;
use App\Exports\Rrhh\Asistencias\AusenciaExport;
use Maatwebsite\Excel\Facades\Excel;
class VerAusencias extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['verDetalle' => 'ver'];
    public $titulo, $nombres, $dni, $showModal = false, $detalles, $idR, $tp;
    public function descargar(){
        if($this->tp == 1){
            $nom = 'Vacaciones';
        }elseif($this->tp == 2){
            $nom = 'Permisos';
        }elseif($this->tp == 3){
            $nom = 'Licencias';
        }
        return Excel::download(new AusenciaExport($this->idR, $this->tp),  $nom.' '.date('d-m-Y').'.xlsx');
    }
    public function ver($tp, $id){
        if($tp == 1){
            $this->titulo = 'Vacaciones';
        }elseif($tp == 2){
            $this->titulo = 'Permisos';
        }elseif($tp == 3){
            $this->titulo = 'Licencias';
        }
        $data = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
            ->select('p.id as idp', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'numeroDocumento', 'catalogoTipo_id', 'jornadaTrabajo', 'catalogoTipoContratacion_id', 'p.bancoSueldo_id', 'p.bancoSueldoNumero', 'p.bancoCTS_id', 'p.bancoCTSNumero', 'local_id', 'catalogoCategoria_id', 'catalogoCargo_id', 'fecha', 'asignacionFamiliar', 'acuerdoTipo', 'acuerdoBono', 'periodoPago', 'rrhh_vinculo_laboral.observaciones', 'p.catalogoRegimenPensionario_id', 'p.tipoComision', 'p.cusp', 'irQuinta', 'montoBruto', 'acuerdoMonto', 'aprobarRrhh', 'aprobarContabilidad')
            ->where('rrhh_vinculo_laboral.id', $id)->first();
        $this->nombres = $data->nombres;
        $this->dni = $data->numeroDocumento;
        $this->idR = $id;
        $this->tp = $tp;
        $this->showModal = true;
    }
    public function render() {
        $this->detalles = Ausencia::where('vinculoLaboral_id', $this->idR)->where('motivoAusencia_id', $this->tp)->get();
        return view('livewire.rrhh.asistencias.permisos-licencias.components.ver-ausencias');
    }
}
