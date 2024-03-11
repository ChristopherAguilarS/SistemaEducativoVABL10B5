<?php

namespace App\Http\Livewire\Rrhh\Asistencias\Feriados;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use App\Models\Rrhh\Feriado;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevo' => 'ver', 'borrar', 'eliminar'];
    public $titulo, $state, $showModal = false, $editar = false, $idR, $idSel;
    public function ver($id){
        if($id){
            $this->titulo = "Edición de Feriado";
            $this->editar = true;
            $this->state = Feriado::select('nombre', 'estado')->find($id)->toarray();
            $this->idSel = $id;
            $this->state['updated_by'] = auth()->user()->id;
            $this->state['updated_at'] = date('Y-m-d H:i');
        }else{
            $this->titulo = "Nuevo Feriado";
            $this->editar = false;
            $this->state = ['nombre' => '', 'estado' => 1, 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')];
        }
        $this->showModal = true;
    }
    public function guardar() {
        $validatedData = $this->validate(['state.fecha' => 'required', 'state.descripcion' => 'required']);
        if($this->editar){
            $existe = Feriado::where('descripcion', $this->state['descripcion'])->whereNotIn('id', [$this->idSel])->first();
        }else{
            $existe = Feriado::where('descripcion', $this->state['descripcion'])->first();
        }
        
        if($existe){
            $this->alert('error', 'La descripción ingresada ya existe.');
        }else{
            try{
                DB::beginTransaction();
                    if($this->editar){
                        $this->state['updated_by'] = auth()->user()->id;
                        $this->state['updated_at'] = date('Y-m-d H:i:s');
                        $sav = Feriado::where('id', $this->idSel)->update($this->state);
                    }else{
                        $this->state['created_by'] = auth()->user()->id;
                        $this->state['created_at'] = date('Y-m-d H:i:s');
                        $sav = Feriado::create($this->state);
                    }
                DB::commit();
                $this->alert('success', 'Feriado guardado correctamente.');
                $this->emit('renderizar');
                $this->showModal = false;
            }catch(\Exception $e){
                DB::rollback();
                dd($e);
                $this->alert('error', 'Ocurrio un error inesperado.');
            }
        }
    }
    public function eliminar($id){
        $this->idR = $id;
        $this->confirm('¿Desea eliminar el Feriado: #'.$id.'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    public function borrar(){
        $del1 = Feriado::where('id', $this->idR)->delete();
        $this->showModal = false;
        $this->emit('renderizar');
        $this->alert('success', 'Feriado eliminado correctamente');
    }
    public function render() {
        return view('livewire.rrhh.asistencias.feriados.ver-detalles');
    }
}
