<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Checklist;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use App\Models\Rrhh\HojaAprobacion;
use App\Models\Rrhh\HojaChecklist;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevo' => 'ver', 'borrar', 'eliminar'];
    public $titulo, $state, $showModal = false, $editar = false, $areas = [], $idR;
    public function ver($id){
        if($id){
            $this->titulo = "Edición de Elemento del Checklist";
            $this->state = ['aprobacion_id' =>0, 'descripcion' => '', 'estado' => 1, 'updated_by' => auth()->user()->id, 'updated_at' => date('Y-m-d H:i')];
        }else{
            $this->titulo = "Nuevo Elemento del Checklist";
            $this->state = ['aprobacion_id' =>0, 'descripcion' => '', 'estado' => 1, 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')];
        }
        $this->showModal = true;
    }
    public function guardar() {
        $validatedData = $this->validate(['state.aprobacion_id' => 'required|not_in:0', 'state.estado' => 'required|not_in:0', 'state.descripcion' => 'required']);
        $existe = HojaChecklist::where('aprobacion_id', $this->state['aprobacion_id'])->where('descripcion', $this->state['descripcion'])->first();
        if($existe){
            $this->alert('error', 'La descripción ingresada ya existe.');
        }else{
            try{
                DB::beginTransaction();
                    $sav = HojaChecklist::create($this->state);
                DB::commit();
                $this->alert('success', 'Checklist guardado correctamente.');
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
        $this->confirm('¿Desea eliminar el Cheklist: #'.$id.'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    public function borrar(){
        $del1 = HojaChecklist::where('id', $this->idR)->delete();
        $this->showModal = false;
        $this->emit('renderizar');
        $this->alert('success', 'Checklist eliminado correctamente');
    }
    public function mount(){
        $this->areas = HojaAprobacion::get();
    }
    public function render() {
        return view('livewire.rrhh.configuracion.checklist.ver-detalles');
    }
}
