<?php
namespace App\Livewire\Rrhh\Horarios\ProgramacionMensual;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use DB;
use App\Models\RecursosHumanos\ProgramacionAutomatica;
use App\Models\RecursosHumanos\ProgramacionPersona;
use App\Models\RecursosHumanos\ProgramacionAutomaticaDetalle;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $showModal = false, $editar = false, $programaciones, $selHorario = 0, $dias = [null, null, null, null, null, null, null, null], $idR = 0;
    #[On('nuevaProgramacion')]
    public function ver($id = 0){
        $this->idR = $id;
        $this->programaciones = ProgramacionAutomatica::where('Estado', 1)->get();
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }

    public function guardar() {
        try{
            DB::beginTransaction();
            if($this->editar){
                $sav = ProgramacionPersona::find($this->editar);
                    $sav->programacionAutomatica_id = $this->selHorario;
                $sav->save();
            }else{
                $sav = ProgramacionPersona::updateorcreate(['persona_id' => $this->idR, 'programacionAutomatica_id' => $this->selHorario], ['persona_id' => $this->idR, 'programacionAutomatica_id' => $this->selHorario, 'created_by' =>auth()->user()->id, 'created_at' => date('Y-m-d H:i')]);
            }
            DB::commit();
            $this->dispatch('rTabla2');
            $this->dispatch('alert_info', ['mensaje' => 'Se agregaron agregado correctamente.']);
        }catch(\Exception $e){dd($e);
            DB::rollback();
            $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un error inesperado.']);
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        $dias = ProgramacionAutomaticaDetalle::join('rrhh_turnos as t', 't.Id', 'rrhh_programaciones_automaticas_detalle.turno_id')
        ->select('dia', 'rrhh_programaciones_automaticas_detalle.id', 't.descripcion', 'horaInicio', 'horaFin', 'abreviatura')
        ->where('programacionAutomatica_id', $this->selHorario)
        ->orderby('horaInicio','asc')->get();

        $this->dias[1] = $dias->where('dia', 1);
        $this->dias[2] = $dias->where('dia', 2);
        $this->dias[3] = $dias->where('dia', 3);
        $this->dias[4] = $dias->where('dia', 4);
        $this->dias[5] = $dias->where('dia', 5);
        $this->dias[6] = $dias->where('dia', 6);
        $this->dias[7] = $dias->where('dia', 7);
        return view('livewire.rrhh.horarios.programacion-mensual.ver-detalles');
    }
}
