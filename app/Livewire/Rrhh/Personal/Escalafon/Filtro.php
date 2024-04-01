<?php
namespace App\Livewire\Rrhh\Personal\Escalafon;
use Livewire\Component;
use DB;
use App\Models\RecursosHumanos\VinculoLaboral;
class Filtro extends Component{
    public $estado = 1, $seleccion = 0, $trabajadores;
    public function mount(){
        $this->anio = date('Y');
    }
    public function cEstado(){
        $this->dispatch('rTablaEstado', $this->seleccion);
    }

    public function render(){
        $this->trabajadores = VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', 'p.id')
            ->leftjoin('rrhh_catalogo_condiciones as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogo_condiciones_id')
            ->leftjoin('rrhh_catalogo_areas as ca', 'ca.id', 'rrhh_vinculo_laboral.catalogo_area_id')
            ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'numeroDocumento AS dni', 'p.id', 'rrhh_vinculo_laboral.fecha_inicio', 'ca.descripcion as area', 'catalogo_tipo_trabajador_id')
            ->where('rrhh_vinculo_laboral.estado', 1)
            ->get();
        return view('livewire.rrhh.personal.escalafon.filtro');
    }
}