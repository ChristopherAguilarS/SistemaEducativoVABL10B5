<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Profesiones;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use App\Models\Rrhh\Profesion;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevo' => 'ver', 'borrar', 'eliminar'];
    public $titulo, $state, $showModal = false, $editar = false, $idR, $idSel, $nivel = 0;
    public function ver($id){
        if($id){
            $this->titulo = "Edición de Profesiones";
            $this->editar = true;
            $this->state = Profesion::select('nombre', 'nivel_id','estado')->find($id)->toarray();
            $this->idSel = $id;
            $this->state['updated_by'] = auth()->user()->id;
            $this->state['updated_at'] = date('Y-m-d H:i');
        }else{
            $this->titulo = "Nueva Profesión";
            $this->editar = false;
            $this->state = ['nombre' => '', 'nivel_id' => 0, 'estado' => 1, 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')];
        }
        $this->showModal = true;
    }
    public function guardar() {
        $validatedData = $this->validate(['state.estado' => 'required', 'state.nivel_id' => 'required|not_in:0', 'state.nombre' => 'required']);
        if($this->editar){
            $existe = Profesion::where('nombre', $this->state['nombre'])->where('nivel_id', $this->nivel)->whereNotIn('id', [$this->idSel])->first();
        }else{
            $existe = Profesion::where('nombre', $this->state['nombre'])->where('nivel_id', $this->nivel)->first();
        }
        
        if($existe){
            $this->alert('error', 'La descripción ingresada ya existe.');
        }else{
            try{
                DB::beginTransaction();
                    if($this->editar){
                        $sav = Profesion::where('id', $this->idSel)->update($this->state);
                    }else{
                        $sav = Profesion::create($this->state);
                    }
                DB::commit();
                $this->alert('success', 'Profesión guardado correctamente.');
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
        $this->confirm('¿Desea eliminar la profesión: #'.$id.'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    public function borrar(){
        $del1 = Profesion::where('id', $this->idR)->delete();
        $this->showModal = false;
        $this->emit('renderizar');
        $this->alert('success', 'PRofesion eliminado correctamente');
    }
    public function render() {
        return view('livewire.rrhh.configuracion.profesiones.ver-detalles');
    }
}
