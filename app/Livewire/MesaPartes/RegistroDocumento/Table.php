<?php

namespace App\Livewire\MesaPartes\RegistroDocumento;
use App\Models\Patrimonio\Equipo;
use App\Models\Patrimonio\EquipoPrestamo;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $esado = 0, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($grupo, $clase){
        $this->grupo = $grupo;
        $this->clase = $clase;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function render(){
        $data = Equipo::leftjoin('rrhh_personas as rp', 'rp.id', 'log_equipos.prestamo_persona_id')
            ->select('log_equipos.id', 'log_equipos.CODIGO_ACTIVO', 'log_equipos.DESCRIPCION', 'log_equipos.id as equipo_id', 'rp.id as prestado', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ' ', nombres) as nombres"))
            ->where('prestamo', 1)
            ->paginate($this->perPage);
        return view('livewire.mesa-partes.registro-documento.table',['posts' => $data]);
    }
}