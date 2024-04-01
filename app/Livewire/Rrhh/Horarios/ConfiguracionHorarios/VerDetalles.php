<?php
namespace App\Livewire\Rrhh\Horarios\ConfiguracionHorarios;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use DB;
use App\Models\RecursosHumanos\Turno;
use App\Models\RecursosHumanos\ProgramacionAutomatica;
use App\Models\RecursosHumanos\ProgramacionAutomaticaDetalle;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $state=['nombre' => ''], $turnos,$showModal = false, $editar = false, $dias = [null, null, null, null, null, null, null, null], $addDia = [0,0,0,0,0,0,0,0], $selId, $userNombre, $userFecha, $idR;

    #[On('nuevo')]
    public function ver($id = 0, $tp = 1){
        if($id){
            $this->dias = [];
            $this->titulo = "Edición de Horario";
            $data = ProgramacionAutomatica::join('users as u', 'u.id', 'rrhh_programaciones_automaticas.created_by')->select('rrhh_programaciones_automaticas.nombre', 'rrhh_programaciones_automaticas.estado', 'rrhh_programaciones_automaticas.created_at', 'u.name')->where('rrhh_programaciones_automaticas.id',$id)->first();
            $this->userNombre = $data->name;
            $this->userFecha = date('Y-m-d', strtotime($data->created_at));
            $this->state = ['nombre' => $data->nombre, 'estado' => $data->estado];
            $dias = ProgramacionAutomaticaDetalle::join('rrhh_turnos as t', 't.id', 'rrhh_programaciones_automaticas_detalle.turno_id')->select('rrhh_programaciones_automaticas_detalle.dia', 't.id', 'horaInicio', 'horaFin', 'abreviatura')->where('programacionAutomatica_id', $id)->orderby('horaInicio','asc')->get();

            for ($i=1; $i <=7 ; $i++) { 
                $sel = $dias->where('dia', $i);
                foreach ($sel as $dia) {
                    $this->dias[$i][$dia->id] = ['id' => $dia->id, 'dia' => $i, 'inicio' => date('h:i a', strtotime($dia->horaInicio)), 'fin' => date('h:i a', strtotime($dia->horaFin)), 'ab' => $dia->abreviatura];
                }
            }
            $this->editar = true;
        }else{
            $this->titulo = "Nuevo Horario";
            $this->userNombre = '';
            $this->userFecha = date('Y-m-d');
            $this->state = ['nombre' => '', 'estado' => 1];
            $this->dias = [];
            $this->editar = false;
        }
        $this->selId = $id;
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('eliminar')]
    public function eliminar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el turno #'.($id), 'funcion' => 'brTurno']);
    }
    #[On('brTurno')]
    public function brTurno(){
        $del1 = ProgramacionAutomatica::where('id', $this->idR)->delete();
        $del2 = ProgramacionAutomaticaDetalle::where('programacionAutomatica_id', $this->idR)->delete();
        $this->dispatch('rTabla2');
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        $err = 0;

        $validatedData = $this->validate(['state.nombre' => 'required']);
        if($this->editar){
            $id = $this->selId;
            $sav = ProgramacionAutomatica::where('id', $id)->update($this->state);
            $del = ProgramacionAutomaticaDetalle::where('programacionAutomatica_id', $this->selId)->delete();
        }else{
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i');
            $dta = ProgramacionAutomatica::where('nombre', $this->state['nombre'])->first();
          
            if(isset($dta->nombre)){
                $this->dispatch('alert_danger', ['mensaje' => 'El nombre ingresado ya se encuentra registrado.']);
                $err = 1;
            }else{
                $sav = ProgramacionAutomatica::create($this->state);
                $id = $sav->id;
            }
        }

        for ($i=1; $i <=7 ; $i++) {
            if(isset($this->dias[$i])){
                foreach ($this->dias[$i] as $dia) {
                    ProgramacionAutomaticaDetalle::updateorcreate(
                        ['id' => $dia['dia'].$dia['id'].$id],
                        ['dia' => $dia['dia'], 'programacionAutomatica_id'=>$id, 'turno_id' => $dia['id'], 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')]);
                }
            }
        }
        if(!$err){
            $this->showModal = false;
            $this->dispatch('rTabla2');
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            $this->dispatch('alert_info', ['mensaje' => 'Horaro guardado correctamente.']);
        }
    }
    public function add($dia){
        if($this->addDia[$dia]){
            $data = Turno::find($this->addDia[$dia]);
            $this->dias[$dia][$data->id] = ['id' => $data->id, 'dia' => $dia, 'inicio' => $data->horaInicio, 'fin' => $data->horaFin, 'ab' => $data->abreviatura];
        }else{
            $this->dispatch('alert_info', ['mensaje' => 'Debes de seleccionar un turno']);
        }
    }
    public function delDia($dia, $id){
        unset($this->dias[$dia][$id]);
        $this->dispatch('alert_info', ['mensaje' => 'Turno retirado generado correctamente.']);
    }
    public function mount(){
        $this->turnos = Turno::orderby('horaInicio','asc')->get();
    }
    public function render(){
        return view('livewire.rrhh.horarios.configuracion-horarios.ver-detalles');
    }
}
