<?php
namespace App\Livewire\Configuracion\Roles\Components;

use App\Models\Administracion\Menus;
use App\Models\Configuracion\RoleMenu;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Configuracion\Rol;
class VerMenus extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $state = ['rol', 'usuario', 'creado'], $rol_id, $idDel, $modulos, $modulo, $roles, $v_modulos, $v_menus, $v_submenus, $chk = [];

    #[On('nuevoMenu')]
    public function ver($id){
        $this->editar = false;
        $this->rol_id = $id;
        $this->chk = [];
        $this->titulo = "Menus Asignados al Rol";
        if($id){
            $data = Rol::join('users as u', 'u.id', 'roles.created_by')
                ->select('u.name as usuario', 'roles.name as rol', 'roles.created_at as creado')
                ->where('roles.id', $id)
                ->first();
            $this->state = ['rol' => $data->rol, 'usuario' => $data->usuario, 'creado' => date('Y-m-d', strtotime($data->creado))];
            $this->roles = RoleMenu::where('role_id', $id)->get();
            foreach ($this->roles as $rol) {
                $this->chk[$rol->menu_id] = true;
            }   
        }
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
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
        if($this->roles){
            $del = RoleMenu::where('role_id', $this->rol_id)->delete();
        }
        foreach ($this->chk as $key => $value) {
            if($value){
                $id = $this->rol_id.str_pad($key, 6, "0", STR_PAD_LEFT);
                $sav = RoleMenu::create([
                    'id' => $id,
                    'role_id' => $this->rol_id,
                    'menu_id' => $key,
                    'created_by' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
            
        }
        $this->dispatch('alert_info', ['mensaje' => 'Rol actualizado correctamente']);
        
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
    }
    public function render(){
        $this->modulos = Menus::where('tipo', 1)->orderBy('nombre', 'asc')->get();
        $data = Menus::where('raiz', $this->modulo)->orderBy('tipo', 'asc')->orderBy('pos', 'asc')->get();
        $this->v_modulos = $data->where('tipo', 1);
        $this->v_menus = $data->where('tipo', 2);
        $this->v_submenus = $data->where('tipo', 3);
        return view('livewire.configuracion.roles.components.ver-menus');
    }
}
