<?php

namespace App\Http\Livewire\Rrhh\Asistencias\TareoObra;
use Livewire\Component;
use App\Models\Rrhh\VinculoLaboral;
use App\Models\Rrhh\Ausencia;
use App\Models\Administracion\Local;
use App\Models\Rrhh\Tareo;
use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Tabla extends Component
{
    use LivewireAlert;
    protected $listeners = ['resetTabla', 'rTabla'];
    public $perPage = 20;
    public $resetFiltros = 0, $inicio, $fin, $local, $tipoTareo, $tipoTrabajador, $anio, $mes, $semana, $semanas, $selectPersona, $tolerancia = 5, $falta = 5, $personas, $ausencias, $arFech = [], $estadoTrabajador, $data_pers = [];
    
   public function rTabla(){
    $this->render();
   }
    public function guardar(){
        //dd($this->arFech);
        foreach ($this->data_pers as $persona) {
            $mes = date('m', strtotime($this->inicio));
            $anio = date('Y', strtotime($this->inicio));
            unset($persona['nombre']);
            unset($persona['dni']);
            unset($persona['cargo']);
            unset($persona['tipo']);
            $persona['vinculoLaboral_id'] = $persona['id'];
            $persona['id'] = $anio.$mes.$persona['id'];
            $persona['mes'] = $mes;
            $persona['anio'] = $anio;
            $persona['estado'] = 1;
            $persona['created_by'] =0;
            $persona['created_at'] ='2023-04-01 08:00';

            $sav = Tareo::updateorcreate(['id' => $anio.$mes.$persona['vinculoLaboral_id'] ], $persona);
        }
        $this->alert('success', 'Tareos actualizados correctamente');
    }
   public function resetFiltros(){
       $this->resetFiltros = 0 ;
   }
   public function resetTabla($lugar, $anio, $mes, $tipoTrabajador, $tipoTareo, $estadoTrabajador){
       $this->resetFiltros = 1;
       $this->tipoTrabajador = $tipoTrabajador;
       $this->estadoTrabajador = $estadoTrabajador;
       $this->tipoTareo = $tipoTareo;
       $this->inicio = $anio;
       $this->fin = $mes;
       
       $this->local = $lugar;
       if($lugar){
            $data = Local::find($lugar);
            $this->tolerancia = $data->tardanza;
            $this->falta = $data->falta;
       }
   }
   public function mount(){
        $this->tolerancia = 10;
        $this->falta = 30;
   }
   public function render() {
       if ($this->resetFiltros) {
            $this->personas =VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', '=', 'p.id')
                ->join('rrhh_catalogo_cargos as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogoCargo_id')
                ->select(DB::raw("CONCAT(p.apellidoPaterno,' ', p.apellidoMaterno, ', ', p.nombres) AS nom"), 'fecha as inicio', 'fechaCese as fin','numeroDocumento as numero','cc.nombre as cargo', "catalogoTipo_id as tipo", "p.id as persona", "rrhh_vinculo_laboral.id")
                ->where("rrhh_vinculo_laboral.estado", $this->estadoTrabajador);
            if($this->tipoTrabajador){
                $this->personas = $this->personas->where('catalogoTipo_id', $this->tipoTrabajador);
            }
            $mes = date('m', strtotime($this->inicio));
            $anio = date('Y', strtotime($this->inicio));
            $this->ausencias=Ausencia::join("rrhh_vinculo_laboral as vl", "vl.id","rrhh_ausencias.vinculoLaboral_id")
                   ->join("rrhh_ausencias_motivos as ma","ma.id","rrhh_ausencias.motivoAusencia_id")
                   ->join("rrhh_ausencia_tipo as ta","ta.id","ma.tipoAusencia_id")
                   ->select("inicio as Inicio", "fin as Fin", "motivoAusencia_id", "ma.id", "ma.descripcion", "vl.persona_id as persona")
                   ->whereRaw("vl.estado=1 and ('".$this->inicio."' BETWEEN rrhh_ausencias.inicio and rrhh_ausencias.fin OR '".$this->fin."' BETWEEN rrhh_ausencias.inicio and rrhh_ausencias.fin OR rrhh_ausencias.inicio BETWEEN '".$this->inicio."' and '".$this->fin."' OR rrhh_ausencias.fin BETWEEN '".$this->inicio."' and '".$this->fin."')")->get();

            $this->personas = $this->personas->where('rrhh_vinculo_laboral.local_id',$this->local)->orderby('apellidoPaterno', 'asc')->orderby('apellidoMaterno', 'asc')->orderby('nombres', 'asc')->get();
           
           if ($this->personas) {
               $idv = $this->personas->pluck('id');
               
               $arr = ['vinculoLaboral_id'];
               for ($i=$this->inicio; $i <= $this->fin; $i = date('Y-m-d', strtotime($i .'+ 1 days'))) {
                    $arr[] = 'A'.date('d', strtotime($i));
                    $this->arFech[] = 'A'.date('d', strtotime($i));
                }
               $marcaciones = Tareo::select($arr)->whereIn('vinculoLaboral_id', $idv)->where('mes', $mes)->where('anio', $anio)->get();

               $data_pers = [];         

               if ($this->personas->count()>0) {
                   foreach ($this->personas as $persona){
                        $data_pers[$persona->id] = ['id' => $persona->id, 'nombre' => $persona->nom, 'inicio' => $persona->inicio, 'fin' => $persona->fin,'dni' => $persona->numero, 'cargo' => $persona->cargo, 'tipo' => $persona->tipo];
                        for ($i=$this->inicio; $i <= $this->fin; $i = date('Y-m-d', strtotime($i .'+ 1 days'))) {
                            $dd = 'A'.date('d', strtotime($i));
                            $f = $marcaciones->where('vinculoLaboral_id', $persona->id)->first();
                            if($f){$d = $f->$dd;}else{$d = 0;}
                            $data_pers[$persona->id][$dd] = $d;
                        }
                        //dd($data_pers);
                   }
               }
               $this->data_pers = $data_pers;
              
          //     dd($this->data_pers);
           }
       }
       return view('livewire.rrhh.asistencias.tareo-obra.tabla');
    }
}
