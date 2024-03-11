<?php

namespace App\Http\Livewire\Rrhh\Configuracion\VariablesGlobales;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use App\Models\rrhh\VariableGlobal;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevo' => 'ver', 'borrar', 'eliminar'];
    public $titulo, $state, $showModal = false, $editar = false, $idR, $idSel, $monto;
    public function ver($id){
        $data = VariableGlobal::find(1);
        $this->monto = $data->asignacion_familiar;
        $this->showModal = true;
    }
    public function guardar() {
        $validatedData = $this->validate(['monto' => 'required|not_in:0']);
        
            try{
                DB::beginTransaction();
                        $sav = VariableGlobal::where('id', 1)->update(['asignacion_familiar'=> $this->monto]);
                  
                DB::commit();
                $this->alert('success', 'Variable actualizada correctamente.');
                $this->emit('renderizar');
                $this->showModal = false;
            }catch(\Exception $e){
                DB::rollback();
                dd($e);
                $this->alert('error', 'Ocurrio un error inesperado.');
            }
        
    }
    public function eliminar($id){
        $this->idR = $id;
        $this->confirm('¿Desea eliminar el Banco: #'.$id.'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    public function borrar(){
        $del1 = Banco::where('id', $this->idR)->delete();
        $this->showModal = false;
        $this->emit('renderizar');
        $this->alert('success', 'Banco eliminado correctamente');
    }
    public function render() {
        return view('livewire.rrhh.configuracion.variables-globales.ver-detalles');
    }
}
