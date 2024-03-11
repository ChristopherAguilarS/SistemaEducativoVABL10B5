<?php

namespace App\Http\Livewire\Rrhh\Horarios\ProgramacionMensual;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Models\Rrhh\ProgramacionAutomatica;
use App\Models\Rrhh\ProgramacionAutomaticaDetalle;
use App\Models\Rrhh\ProgramacionPersona;
class VerDetalles extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['nuevaProgramacion' => 'ver'];
    public $showModal = false, $editar = false, $programaciones, $selHorario = 0, $dias = [null, null, null, null, null, null, null, null], $idR = 0;

    protected $rules = [
        'state.catalogoOperador_id' => 'required|not_in:0',
        'state.numero' => 'required'
    ];
    public function ver($id){
        $this->idR = $id;
        $this->programaciones = ProgramacionAutomatica::where('Estado', 1)->get();
        $this->showModal = true;
    }
    public function guardar() {
        $sav = ProgramacionPersona::updateorcreate(['persona_id' => $this->idR, 'programacionAutomatica_id' => $this->selHorario], ['persona_id' => $this->idR, 'programacionAutomatica_id' => $this->selHorario, 'created_by' =>auth()->user()->id, 'created_at' => date('Y-m-d H:i')]);
        $this->alert('success', 'Trabajador Programado Correctamente.');
        $this->emit('renderizar');
        $this->showModal = false;
    }
    public function mount(){
    }
    public function render() {

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
//dd($this->dias);
        return view('livewire.rrhh.horarios.programacion-mensual.ver-detalles');
    }
}
