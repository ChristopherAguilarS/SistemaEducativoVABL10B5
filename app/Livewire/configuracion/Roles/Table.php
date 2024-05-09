<?php

namespace App\Livewire\Configuracion\Roles;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Configuracion\Rol;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estado = 1, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($estado){
        $this->estado = $estado;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function render(){
        $data = Rol::join('menu as m', 'm.id', 'roles.modulo_id')
            ->select('m.nombre as modulo', 'name as rol', 'roles.estado', 'roles.id')
            ->orderby('name', 'asc')->where('roles.estado', 1)->get();
        return view('livewire.configuracion.roles.table',['posts' => $data]);
    }
}