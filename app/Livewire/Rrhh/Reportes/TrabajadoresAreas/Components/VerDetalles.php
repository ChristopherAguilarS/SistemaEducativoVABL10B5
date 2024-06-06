<?php
namespace App\Livewire\Rrhh\Reportes\TrabajadoresAreas\Components;

use App\Models\RecursosHumanos\VinculoLaboral;
use App\Models\RecursosHumanos\CatalogoArea;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use DB;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $area = '', $state = ['descripcion' =>'', 'estado' =>1], $trabajadores, $idSel;

    #[On('nuevo')]
    public function ver($id){
        $this->idSel = $id;
        $ar = CatalogoArea::find($id);
        $this->area = $ar->descripcion;
        $trabajadores = VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', 'p.id')
            ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'numeroDocumento AS dni')
            ->where('rrhh_vinculo_laboral.catalogo_area_id', $this->idSel)
            ->get();
        if($trabajadores){
            $this->trabajadores = $trabajadores->toArray();
        }else{
            $this->trabajadores = null;
        }
        
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    public function render(){
        return view('livewire.rrhh.reportes.trabajadores-areas.components.ver-detalles');
    }
}
