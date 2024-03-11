<?php

namespace App\Http\Livewire\Rrhh\Horarios\ConfiguracionTurnos;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Rrhh\Turno;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevoTurno' => 'ver', 'eliminar', 'borrar'];
    public $showModal = false, $titulo, $editar = false, $state, $selId = 0;

    protected $rules = [
        'state.catalogoOperador_id' => 'required|not_in:0',
        'state.numero' => 'required'
    ];
    public function ver($id){
        $this->selId = $id;
        if($id){
            $this->titulo = "Editar Turno";
            $this->state = Turno::select('horaInicio', 'horaFin', 'descripcion', 'abreviatura', 'estado')->find($id)->toarray();
            $this->editar = true;
        }else{
            $this->titulo = "Nuevo Turno";
            $this->editar = false;
            $this->state = ['horaInicio' => '', 'horaFin' => '', 'descripcion' => '', 'abreviatura' => '', 'estado' => 1];
        }
        $this->showModal = true;
    }
    public function guardar() {
        if($this->editar){
            $sav = Turno::where('id', $this->selId)->update($this->state);
        }else{
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i');
            $dta = Turno::where('descripcion', $this->state['descripcion'])->orWhere('abreviatura', $this->state['abreviatura'])->first();
          
            if(isset($dta->descripcion)){
                $this->alert('error', 'La descripción/abreviatura ingresado ya se encuentra registrado.');
            }else{
                $sav = Turno::create($this->state);
            }
        }
        $this->alert('success', 'Turno Guardado Correctamente.');
        $this->emit('renderizar');
        $this->showModal = false;
    }
    public function eliminar($id){
        $this->selId = $id;
        $this->confirm('¿Desea eliminar el horario: #'.$id.'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    public function borrar(){
        $del1 = Turno::where('id', $this->idR)->delete();
        $this->showModal = false;
        $this->emit('renderizar');
        $this->alert('success', 'Turno eliminado correctamente');
    }
    public function mount(){
    }
    public function render() {

        return view('livewire.rrhh.horarios.configuracion-turnos.ver-detalles');
    }
}
