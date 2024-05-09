<?php

namespace App\Livewire\Configuracion\Usuarios;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
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
        $data = User::orderby('name', 'asc')->where('estado', 1)->paginate($this->perPage);
        return view('livewire.configuracion.usuarios.table',['posts' => $data]);
    }
}