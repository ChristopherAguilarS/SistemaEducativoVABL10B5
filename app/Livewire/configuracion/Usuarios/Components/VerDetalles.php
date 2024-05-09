<?php
namespace App\Livewire\Configuracion\Usuarios\Components;

use App\Models\Administracion\Menus;
use App\Models\Configuracion\Rol;
use App\Models\Configuracion\RoleUser;
use App\Models\RecursosHumanos\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\User;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $state = ['dni' =>'', 'name' =>'', 'email' =>'', 'estado' => 1, 'password_change' => 1, 'master' => 0], $tipo, $idDel, $usuario, $trabajador;
    public $buscar_por, $documento, $trabajador_nombre, $trabajador_id, $trabajadores, $asignados = [], $modulo, $rol, $modulos, $roles;

    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        $this->editar = false;
        $this->buscar_por = 1;
        $this->trabajador_nombre = '';
        $this->documento = '';
       
        if($tipo == 1){
            $this->titulo = "Nuevo Usuario";
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Usuario";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Usuario";
        }
        if($id){
            $this->usuario = User::find($id);
            $this->asignados = Rol::join('role_user as ru', 'roles.id', 'ru.role_id')
                ->join('menu as m', 'm.id', 'roles.modulo_id')
                ->select('m.nombre as modulo', 'roles.name as rol', 'roles.id')
                ->where('ru.user_id', $id)
                ->get();
            $this->asignados = $this->asignados->pluck(null, 'id')->toArray();
            $this->documento = $this->usuario->dni;
            $this->trabajador_nombre = $this->usuario->name;
            $this->state['id'] = $this->usuario->id;
            $this->state['dni'] = $this->usuario->dni;
            $this->state['name'] = $this->usuario->name;
            $this->state['email'] = $this->usuario->email ;
            $this->state['estado'] = $this->usuario->estado;
            $this->state['master'] = $this->usuario->master == null?0:$this->usuario->master;
            
            if($tipo == 3){
                $this->editar = $id;
            }
        }else{
            $this->state = ['dni' =>'', 'name' =>'', 'email' =>'', 'estado' => 1, 'password_change' => 1, 'master' => 0];
            $this->asignados = null;
            $this->modulo = 0;
            $this->roles = null;
            $this->trabajador_id = 0;
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    public function del($id){
        unset($this->asignados[$id]);
        $this->dispatch('alert_info', ['mensaje' => 'Rol retirado Correctamente']);
    }
    public function updatedBuscarPor(){
        $this->state['id'] = null;
    }
    public function updatedModulo($id){
        $this->roles = Rol::where('estado', 1)->where('modulo_id', $id)->get();
    }
    public function aniadir(){
        $v_modulo = $this->modulos->where('id', $this->modulo)->first();
        $v_rol = $this->roles->where('modulo_id', $this->modulo)->first();

        $this->asignados[$this->rol] = [
            'modulo' => $v_modulo->nombre,
            'rol' => $v_rol->name,
            'id' => $this->rol
        ];
    }
    #[On('delCat')]
    public function delCat($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el usuario #'.($id), 'funcion' => 'brCat']);
    }
    #[On('brCat')]
    public function brCat(){
        $del1 = User::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function buscar(){
        $this->idPers = 0;
        $data = Persona::where('numeroDocumento', $this->documento)->first();
        if($data){
            $this->trabajador_nombre = $data->apellidoPaterno.' '.$data->apellidoMaterno.' '.$data->nombres;
            $this->state['name'] = $data->apellidoPaterno.' '.$data->apellidoMaterno.' '.$data->nombres;
            $this->state['id'] = $data->id;
            $this->state['dni'] = $data->numeroDocumento;
            $this->dispatch('alert_info', ['mensaje' => 'Trabajador Encontrado']);
        }else{
            $this->trabajador_nombre = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Trabajador no Encontrado']);
        }
    }
    public function guardar(){
        if(!$this->buscar_por){
            //por nombre
            $this->state['id'] = $this->trabajador_id;
        }
        $this->validate(['state.id' => 'required|not_in:0']);
        $pers = Persona::find($this->state['id']);
        $this->state['dni'] = $pers->numeroDocumento;
        $this->state['name'] = $pers->apellidoPaterno.' '.$pers->apellidoMaterno.' '.$pers->nombres;
        
        $this->validate(['state.id' => 'required|not_in:0','state.name' => 'required', 'state.dni' => 'required|not_in:0', 'state.email' => 'required|not_in:0', 'state.estado' => 'required']);
       
        if($this->editar){
            $this->usuario->dni = $this->state['dni'];
            $this->usuario->name = $this->state['name'];
            $this->usuario->email = $this->state['email'];
            $this->usuario->estado = $this->state['estado'];
            $this->usuario->password_change = $this->state['password_change'];
            $this->usuario->save();
        }else{
            $this->state['guard_name'] = 'web';
            $this->state['password'] = bcrypt($this->state['dni']);
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $sav2 = User::create($this->state);
            
        }
        $del = Roleuser::where('user_id',$this->state['id'])->delete();
        foreach ($this->asignados as $key => $asignado) {
            $id = $this->state['id'].str_pad($key, 6, "0", STR_PAD_LEFT);
            $sav = Roleuser::create([
                'id' => $id,
                'role_id'=> $asignado['id'],
                'user_id'=> $this->state['id'],
                'created_at'=> date('Y-m-d H:i:s')
            ]);
        }
        if($this->editar){
            $this->dispatch('alert_info', ['mensaje' => 'Usuario editado correctamente']);
        }else{
            $this->dispatch('alert_info', ['mensaje' => 'Usuario creado correctamente']);
        }
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        if(!$this->buscar_por){
            $this->trabajadores = Persona::where('estado', 1)->get();
        }
        $this->modulos = Menus::where('tipo', 1)->orderBy('nombre', 'asc')->get();
        return view('livewire.configuracion.usuarios.components.ver-detalles');
    }
}
