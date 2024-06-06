<?php
    namespace App\Exports\Patrimonio\Reportes;
    use Illuminate\Contracts\View\View;
    use Maatwebsite\Excel\Concerns\ShouldAutoSize;
    use Maatwebsite\Excel\Concerns\FromView;
    use App\Models\Patrimonio\Equipo;
    USE DB;
    class EquiposSituacionExport implements FromView, ShouldAutoSize
    {
        public $r_val, $anio, $inventariado;
        public function  __construct($r_val, $anio, $inventariado){
            $this->r_val = $r_val;
            $this->anio = $anio;
            $this->inventariado = $inventariado;
        }

        public function view(): View {
            $posts = Equipo::leftjoin('log_equipos_inventariados as lr', function ($join) {
                $join->on('lr.equipo_id', '=', 'log_equipos.id')
                ->on('lr.estado', '=', DB::raw('1'))
                ->on('lr.anio', '=', DB::raw($this->anio));
            })
            ->leftjoin('rrhh_personas as p', 'p.id', 'lr.persona_id')
            ->leftjoin('log_ambientes as a', 'a.id', 'log_equipos.ambiente_id')
            ->select('log_equipos.id', 'log_equipos.CODIGO_ACTIVO', 'a.nombre as ambiente', 'MODELO', 'NRO_SERIE', 'COLOR','lr.id as inventariado','log_equipos.DESCRIPCION', 'log_equipos.OBSERVACIONES', 'log_equipos.ESTADO_CONSERV', 'log_equipos.id', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS trabajador"));
            if($this->r_val){
                $posts = $posts->whereRaw($this->r_val);
            }
            return view('livewire.patrimonio.reportes.equipos-situacion.components.exportar-excel', ['posts' => $posts->get()]);
        }
    }