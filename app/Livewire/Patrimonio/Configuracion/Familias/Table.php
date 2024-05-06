<?php

namespace App\Livewire\Patrimonio\Configuracion\Familias;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patrimonio\Familia;
use App\Models\Patrimonio\Grupo;
use App\Models\Patrimonio\Clase;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $grupo = 0, $clase, $perPage = 20, $grupos, $clases;
    #[On('rTabla')]
    public function rtabla($grupo, $clase){
        $this->grupo = $grupo;
        $this->clase = $clase;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function updatedgrupo($id){
        $this->clases = Clase::where('grupo', $id)->get();
    }
    public function mount(){
        $this->grupos = Grupo::get();
    }
    public function render(){
        $data = Familia::query()->where('clase', $this->clase)->where('grupo', $this->grupo)->orderby('familia','asc')->paginate($this->perPage);

        return view('livewire.patrimonio.configuracion.familias.table',['posts' => $data]);
    }
}