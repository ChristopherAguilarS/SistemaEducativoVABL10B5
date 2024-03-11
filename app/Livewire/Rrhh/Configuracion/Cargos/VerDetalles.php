<?php

namespace App\Http\Livewire\Rrhh\Configuracion\Cargos;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use App\Models\Rrhh\TipoTrabajador;
use App\Models\Rrhh\Cargo;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevo' => 'ver', 'borrar', 'eliminar'];
    public $titulo, $state, $showModal = false, $editar = false, $tipos = [], $categoria, $tipo, $idR, $idSel;
    public function ver($id){
        if($id){
            $this->titulo = "Edición de Elemento del Checklist";
            $this->editar = true;
            $data = Cargo::select('tipo', 'categoria', 'nombre', 'estado')->find($id);
            $this->idSel = $id;
            $this->categoria = $data->categoria;
            $this->tipo = $data->tipo;
            $this->state['nombre'] = $data->nombre;
            $this->state['estado'] = $data->estado;
            $this->state['updated_by'] = auth()->user()->id;
            $this->state['updated_at'] = date('Y-m-d H:i');
        }else{
            $this->titulo = "Nuevo Elemento del Checklist";
            $this->editar = false;
            $this->state = ['tipo' =>0, 'categoria' =>0, 'nombre' => '', 'estado' => 1, 'created_by' => auth()->user()->id, 'created_at' => date('Y-m-d H:i')];
        }
        $this->showModal = true;
    }
    public function guardar() {
        if($this->tipo == 3){
            $validatedData = $this->validate(['tipo' => 'required|not_in:0', 'categoria' => 'required|not_in:0', 'state.nombre' => 'required']);
        }else{
            $this->categoria = null;
            $validatedData = $this->validate(['tipo' => 'required|not_in:0', 'state.nombre' => 'required']);
        }
        $this->state['tipo'] = $this->tipo;
        $this->state['categoria'] = $this->categoria;
        $existe = Cargo::where('tipo', $this->tipo)->where('categoria', $this->categoria)->where('nombre', $this->state['nombre'])->first();
        if($existe){
            $this->alert('error', 'La descripción ingresada ya existe.');
        }else{
            try{
                DB::beginTransaction();
                    if($this->editar){
                        $sav = Cargo::where('id', $this->idSel)->update($this->state);
                    }else{
                        $sav = Cargo::create($this->state);
                    }
                DB::commit();
                $this->alert('success', 'Cargo guardado correctamente.');
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
        $this->confirm('¿Desea eliminar el Cargo: #'.$id.'?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    public function borrar(){
        $del1 = Cargo::where('id', $this->idR)->delete();
        $this->showModal = false;
        $this->emit('renderizar');
        $this->alert('success', 'Checklist eliminado correctamente');
    }
    public function mount(){
        $this->tipos = TipoTrabajador::get();
    }
    public function render() {
        return view('livewire.rrhh.configuracion.cargos.ver-detalles');
    }
}
