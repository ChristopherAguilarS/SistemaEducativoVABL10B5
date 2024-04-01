<?php
namespace App\Livewire\Rrhh\Horarios\Turnos;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use DB;
use App\Models\RecursosHumanos\Turno;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = ['almacen_id' => 0, 'tipo_id' => 1, 'almacen_destino' =>0], $ver = 0, $editar = false;
    public $revisadoPor, $revisadoEl, $partidas, $prod = [],  $trabajadores, $idDel;
    #[On('nuevo')]
    public function ver($id = 0, $tp = 1){
        if($id){    
            $this->titulo = 'Edicion de Turno';
            $this->editar = $id;
        }else{  
            $this->titulo = 'Nuevo Turno';
            $this->editar = false;
            $this->state = ['descripcion' => '', 'horaInicio' =>null, 'horaFin' =>null, 'abreviatura' =>'', 'estado' =>1];
        }
        if($id){
            $data = Turno::find($id);
            $this->state = ['descripcion' => $data->descripcion, 'horaInicio' =>$data->horaInicio, 'horaFin' =>$data->horaFin, 'abreviatura' =>$data->abreviatura, 'estado' =>$data->estado];
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('eliminar')]
    public function eliminar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el turno #'.($id), 'funcion' => 'brTurno']);
    }
    #[On('brTurno')]
    public function brTurno(){
        $sav = Turno::where('id',$this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar() {
        $this->state['created_by'] = auth()->user()->id;
        $this->state['created_at'] = date('Y-m-d H:i');
        $this->validate(['state.descripcion' => 'required', 'state.horaInicio' => 'required', 'state.horaFin' => 'required', 'state.abreviatura' => 'required']);

        try{
            DB::beginTransaction();
            if($this->editar){
                $sav = Turno::find($this->editar);
                    $sav->descripcion = $this->state['descripcion'];
                    $sav->horaInicio = $this->state['horaInicio'];
                    $sav->horaFin = $this->state['horaFin'];
                    $sav->abreviatura = $this->state['abreviatura'];
                $sav->save();
            }else{
                $sav = Turno::create($this->state);
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
        return view('livewire.rrhh.horarios.turnos.ver-detalles');
    }
}
