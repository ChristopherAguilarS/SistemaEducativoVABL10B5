<?php

namespace App\Livewire\Academico\Academico\Matriculas;

use App\Models\Academico\Carrera;
use App\Models\Academico\Alumno;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = ['modalidad_ingreso'=>0], $editar = false, $idDel, $busqueda, $documento;
    #[On('nuevo')]
    public function onNuevo($id = 0){
        if($id){
            $this->titulo = "Editar Nivel Academico";
            $this->state = Carrera::find($id)->toarray();
            $this->editar = $id;
        }else{
            $this->titulo = "Nueva Matrícula";
            $this->state = ['modalidad_ingreso' => 0];
            $this->editar = false;
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    public function buscar(){
        $this->idPers = 0;
        $data = Alumno::leftjoin('academico_matriculas as am', 'am.persona_id', 'academico_alumnos.id')
            ->select('academico_alumnos.id', 'academico_alumnos.apellidoPaterno', 'academico_alumnos.apellidoMaterno', 'academico_alumnos.nombres', 'am.estado')
            ->where('academico_alumnos.numeroDocumento', $this->documento)->first();
        if($data){
            if($data->estado == 1){
                $this->dispatch('alert_danger', ['mensaje' => 'El Alumno ya tiene una matricula vigente']);
            }else{
                $this->nombres = $data->apellidoPaterno.' '.$data->apellidoMaterno.', '.$data->nombres;
                $this->idPers = $data->id;
                $this->busqueda = true;
                $this->dispatch('alert_info', ['mensaje' => 'Alumno Encontrado']);
            }
        }else{
            $this->idPers = 0;
            $this->busqueda = true;
            $this->nombres = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Alumno no Encontrado']);
        }
    }
    #[On('eliminar')]
    public function eliminar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el nivel con codigo Nro.'.$id, 'funcion' => 'brNivel']);
    }
    #[On('brNivel')]
    public function brNivel(){
        $sav = Carrera::find($this->idDel);
        $sav->delete();
        $this->dispatch('rTabla');
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        $this->validate([ 
            'state.nombre' => 'required',
            'state.estado' => 'required',
        ]);
        try {
            if($this->editar){
                $nivel = Carrera::find($this->editar);
                $nivel->nombre = $this->state['nombre'];
                $nivel->estado = $this->state['estado'];
                $nivel->save();
            }else{
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d');
                $nivel = Carrera::create($this->state);
            }
            $this->dispatch('alert_info', ['mensaje' => 'Guardado Correctamente']);
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        return view('livewire.academico.academico.matriculas.ver-detalles');
    }
}
