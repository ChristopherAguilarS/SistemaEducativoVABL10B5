<?php
    namespace App\Exports\Patrimonio;
    use Illuminate\Contracts\View\View;
    use Maatwebsite\Excel\Concerns\ShouldAutoSize;
    use Maatwebsite\Excel\Concerns\FromView;
    use App\Models\Patrimonio\Ambiente;
    USE DB;
    class AmbientesExport implements FromView, ShouldAutoSize
    {
        public $estado, $pabellon;
        public function  __construct($estado, $pabellon){
            $this->estado = $estado;
            $this->pabellon = $pabellon;
        }

        public function view(): View {
            $data = Ambiente::leftjoin('log_catalogo_tipos_ambientes as ct', 'ct.id', 'log_ambientes.catalogo_tipo_ambiente_id')
                ->leftjoin('log_catalogo_pabellones as u', 'u.id', 'log_ambientes.catalogo_pabellon_id')
                ->leftjoin('log_catalogo_pisos as p', 'p.id', 'log_ambientes.catalogo_piso_id')
                ->leftjoin('log_catalogo_uso_ambientes as cu', 'cu.id', 'log_ambientes.catalogo_uso_ambiente_id')
                ->leftjoin('log_catalogo_tipo_techo as ctt', 'ctt.id', 'log_ambientes.catalogo_tipo_techo_id')
                ->leftjoin('log_catalogo_tipo_pisos as ctp', 'ctp.id', 'log_ambientes.catalogo_tipo_piso_id')
                ->select(
                    'log_ambientes.nombre',
                    'ct.descripcion as tipo_ambiente',
                    'u.descripcion as pabellon',
                    'p.descripcion as piso',
                    'log_ambientes.estado_conservacion',
                    'cu.descripcion as uso',
                    'log_ambientes.aforo',
                    'log_ambientes.largo',
                    'log_ambientes.ancho',
                    'log_ambientes.alto',
                    'log_ambientes.area',
                    'log_ambientes.tipo_uso',
                    'log_ambientes.puertas',
                    'log_ambientes.ventanas',
                    'ctt.descripcion as tipo_techo',
                    'ctp.descripcion as tipo_piso',
                    'log_ambientes.luces_emergencia',
                    'log_ambientes.alarmas',
                    'log_ambientes.extintores',
                    'log_ambientes.escritorios_total',
                    'log_ambientes.escritorios_buenos',
                    'log_ambientes.escritorios_regulares',
                    'log_ambientes.escritorios_malos',
                    'log_ambientes.sillas_total',
                    'log_ambientes.sillas_buenos',
                    'log_ambientes.sillas_regulares',
                    'log_ambientes.sillas_malos',
                    'log_ambientes.carpetas_total',
                    'log_ambientes.carpetas_buenos',
                    'log_ambientes.carpetas_regulares',
                    'log_ambientes.carpetas_malos',
                    'log_ambientes.armarios_total',
                    'log_ambientes.armarios_buenos',
                    'log_ambientes.armarios_regulares',
                    'log_ambientes.armarios_malos',
                    'log_ambientes.proyectores_total',
                    'log_ambientes.proyectores_buenos',
                    'log_ambientes.proyectores_regulares',
                    'log_ambientes.proyectores_malos',
                    'log_ambientes.pizarras_total',
                    'log_ambientes.pizarras_buenos',
                    'log_ambientes.pizarras_regulares',
                    'log_ambientes.pizarras_malos',
                    'log_ambientes.otros_total',
                    'log_ambientes.otros_buenos',
                    'log_ambientes.otros_regulares',
                    'log_ambientes.otros_malos',
                    'log_ambientes.estado',
                    'log_ambientes.observaciones'
                );
            if($this->estado == 1){
                $data = $data->where('log_ambientes.estado', 1);
            }elseif($this->estado == 2){
                $data = $data->where('log_ambientes.estado', 0);
            }
            if($this->pabellon){
                $data = $data->where('log_ambientes.catalogo_pabellon_id', $this->pabellon);
            }
            return view('livewire.patrimonio.ambientes.components.exportar-excel', ['posts' => $data->get()]);
        }
    }