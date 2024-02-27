<?php

namespace App\Livewire\Academico\Administracion\PlanAcademico;

use App\Models\Academico\Carrera;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = [], $editar = false, $idDel;
    #[On('nuevo')]
    public function onNuevo($id = 0){
        if($id){
            $this->titulo = "Editar Nivel Academico";
            $this->state = Carrera::find($id)->toarray();
            $this->editar = $id;
        }else{
            $this->titulo = "Nuevo Nivel Academico";
            $this->state = ['nombre' => '', 'estado' =>1];
            $this->editar = false;
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
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
        return view('livewire.academico.administracion.plan-academico.ver-detalles');
    }
}
