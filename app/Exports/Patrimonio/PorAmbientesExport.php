<?php
    namespace App\Exports\Patrimonio;
    use Illuminate\Contracts\View\View;
    use Maatwebsite\Excel\Concerns\ShouldAutoSize;
    use Maatwebsite\Excel\Concerns\FromView;
    use App\Models\Patrimonio\Equipo;
    use App\Models\Patrimonio\Ambiente;
    USE DB;
    class PorAmbientesExport implements FromView, ShouldAutoSize
    {
        public $tab, $ambiente, $apPaterno, $apMaterno, $nombres, $nroDocumento, $anio, $inventariado;
        public function  __construct($tab, $ambiente, $apPaterno, $apMaterno, $nombres, $nroDocumento, $anio, $inventariado){
            $this->tab = $tab;
            $this->ambiente = $ambiente;
            $this->apPaterno = $apPaterno;
            $this->apMaterno = $apMaterno;
            $this->nombres = $nombres;
            $this->nroDocumento = $nroDocumento;
            $this->anio = $anio;
            $this->inventariado = $inventariado;
        }

        public function view(): View {
            if($this->ambiente){
                $ambientes = Ambiente::where('id', $this->ambiente)->get();
            }else{
                $ambientes = Ambiente::get();
            }
            
            $posts = Equipo::leftjoin('log_equipos_inventariados as lr', function ($join) {
                    $join->on('lr.equipo_id', '=', 'log_equipos.id')
                        ->on('lr.estado', '=', DB::raw('1'));
                })
                ->leftjoin('rrhh_personas as p', 'p.id', 'lr.persona_id')
                ->leftjoin('log_ambientes as a', 'a.id', 'log_equipos.ambiente_id')
                ->select('log_equipos.ambiente_id', 'log_equipos.id','log_equipos.CODIGO_ACTIVO', 'lr.id as inventariado','log_equipos.DESCRIPCION','log_equipos.NRO_SERIE', 'log_equipos.OBSERVACIONES', 'log_equipos.ESTADO_CONSERV', 'log_equipos.ANCHO', 'log_equipos.LARGO', 'log_equipos.ALTO', 'log_equipos.EN_USO', 'log_equipos.FECHA_COMPRA', 'log_equipos.id', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS trabajador"));
            if($this->inventariado){
                if($this->inventariado == 1){
                    $posts = $posts->whereRaw('lr.id is not null');
                }elseif($this->inventariado == 2){
                    $posts = $posts->whereRaw('lr.id is null');
                }
            }
            if($this->tab == 1){
               
            }elseif($this->tab == 1){
                $posts = $posts->whereRaw("(apellidoPaterno like '%".$this->apPaterno."%' and apellidoMaterno like '%".$this->apMaterno."%' and nombres like '%".$this->nombres."%')");
            }elseif($this->tab == 3){
                $posts = $posts->whereRaw("numeroDocumento like '".$this->nroDocumento."'");
            }
            return view('livewire.patrimonio.por-ambiente.components.exportar-excel', ['posts' => $posts->get(), 'ambientes' => $ambientes]);
        }
    }