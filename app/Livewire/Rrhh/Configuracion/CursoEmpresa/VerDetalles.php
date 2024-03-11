<?php

namespace App\Http\Livewire\Rrhh\Configuracion\CursoEmpresa;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use App\Models\Administracion\EmpresaCurso;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevo' => 'ver', 'borrar', 'eliminar'];
    public $titulo, $state, $showModal = false, $editar = false, $idR, $idSel;
    public function ver($id){
        if($id){
            $this->titulo = "Edición de Empresa - Curso";
            $this->editar = true;
            $this->state = EmpresaCurso::select('nombre', 'estado')->find($id)->toarray();
            $this->idSel = $id;
            $this->state['updated_by'] = auth()->user()->id;
            $this->state['updated_at'] = date('Y-m-d H:i');
        }else{
            $this->titulo = "Nuevo Empresa - Curso";
            $this->editar = false;
            $this->state = ['nombre' => '', 'estado' => 1, 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')];
        }
        $this->showModal = true;
    }
    public function guardar() {
        $validatedData = $this->validate(['state.estado' => 'required', 'state.nombre' => 'required']);
        if($this->editar){
            $existe = EmpresaCurso::where('nombre', $this->state['nombre'])->whereNotIn('id', [$this->idSel])->first();
        }else{
            $existe = EmpresaCurso::where('nombre', $this->state['nombre'])->first();
        }
        
        if($existe){
            $this->alert('error', 'La descripción ingresada ya existe.');
        }else{
            try{
                DB::beginTransaction();
                    if($this->editar){
                        $sav = EmpresaCurso::where('id', $this->idSel)->update($this->state);
                    }else{
                        $sav = EmpresaCurso::create($this->state);
                    }
                DB::commit();
                $this->alert('success', 'Empresa guardado correctamente.');
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
        $this->confirm('¿Desea eliminar la empresa: #'.$id.'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    public function borrar(){
        $del1 = EmpresaCurso::where('id', $this->idR)->delete();
        $this->showModal = false;
        $this->emit('renderizar');
        $this->alert('success', 'Empresa eliminado correctamente');
    }
    public function render() {
        return view('livewire.rrhh.configuracion.curso-empresa.ver-detalles');
    }
}
