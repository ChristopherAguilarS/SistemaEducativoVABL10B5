<?php

namespace App\Livewire\Rrhh\Reportes\TrabajadoresAreas;

use App\Models\RecursosHumanos\CatalogoArea;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render() {
        $areas = CatalogoArea::select('id', 'descripcion', DB::raw("(SELECT count(*) FROM rrhh_vinculo_laboral vl inner join rrhh_personas p on vl.persona_id=p.id where vl.estado=1 and catalogo_area_id=rrhh_catalogo_areas.id) as cant"))->get();

        return view('livewire.rrhh.reportes.trabajadores-areas.table',['cuentas'=>$areas]);
    }
}
