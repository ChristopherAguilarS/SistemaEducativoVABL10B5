<?php
namespace App\Livewire\Configuracion\Roles\Components;

use App\Models\Administracion\Menus;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Configuracion\Rol;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $state = ['name' =>'', 'modulo_id' =>0], $tipo, $idDel, $modulos, $rol;

    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        $this->editar = false;
        if($tipo == 1){
            $this->titulo = "Nuevo Rol";
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Rol";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Rol";
        }
        if($id){
            $this->rol = Rol::find($id);
            $this->state['name'] = $this->rol->name;
            $this->state['modulo_id'] = $this->rol->modulo_id;
            $this->state['estado'] = $this->rol->estado;
            if($tipo == 3){
                $this->editar = $id;
            }
        }else{
            $this->state = ['name' =>'', 'modulo_id' =>0, 'estado' => 1];
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('delCat')]
    public function delCat($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el rol #'.($id), 'funcion' => 'brCat']);
    }
    #[On('brCat')]
    public function brCat(){
        $del1 = Rol::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    
    public function guardar(){
        $this->validate(['state.name' => 'required', 'state.modulo_id' => 'required|not_in:0', 'state.estado' => 'required']);
        if($this->editar){
            $this->rol->name = $this->state['name'];
            $this->rol->estado = $this->state['estado'];
            $this->rol->save();
            $this->dispatch('alert_info', ['mensaje' => 'Rol editado correctamente']);
        }else{
            $this->state['guard_name'] = 'web';
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $sav2 = Rol::create($this->state);
            $this->dispatch('alert_info', ['mensaje' => 'Rol creado correctamente']);
        }
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        $this->modulos = Menus::where('tipo', 1)->orderBy('nombre', 'asc')->get();
        return view('livewire.configuracion.roles.components.ver-detalles');
    }
}
