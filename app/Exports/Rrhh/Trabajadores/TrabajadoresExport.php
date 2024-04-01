<?php
    namespace App\Exports\Rrhh\Trabajadores;
    use Illuminate\Contracts\View\View;
    use Maatwebsite\Excel\Concerns\ShouldAutoSize;
    use Maatwebsite\Excel\Concerns\FromView;
    use App\Models\RecursosHumanos\VinculoLaboral;
    USE DB;
    class TrabajadoresExport implements FromView, ShouldAutoSize
    {
        public $inicio, $fin, $lugar, $almacen = 0;
        public function  __construct(){
            
        }

        public function view(): View {
            $data = VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', 'p.id')
            ->join('rrhh_catalogo_cargos as c', 'rrhh_vinculo_laboral.catalogo_cargo_id', 'c.id')
            ->leftjoin('rrhh_catalogo_condiciones as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogo_condiciones_id')
            ->leftjoin('rrhh_catalogo_regimenes as r', 'r.id', 'cc.catalogo_regimen_id')
            ->leftjoin('rrhh_catalogo_areas as ca', 'ca.id', 'rrhh_vinculo_laboral.catalogo_area_id')
            ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'c.descripcion as cargo', 'numeroDocumento AS dni', 'cc.descripcion as condicion', 'r.descripcion as regimen', 'p.id', 'rrhh_vinculo_laboral.fecha_inicio', 'ca.descripcion as area', 'catalogo_tipo_trabajador_id');

            return view('livewire.rrhh.trabajadores.components.exportar-trabajadores', ['posts' => $data->get()]);
        }
    }