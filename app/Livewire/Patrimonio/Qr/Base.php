<?php
namespace App\Livewire\Patrimonio\Qr;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//--
use App\Models\Patrimonio\EquipoSalida;
use App\Models\Patrimonio\Equipo;
use App\Models\Patrimonio\Familia;
use App\Models\Patrimonio\Clase;
use App\Models\Patrimonio\Grupo;
use App\Models\Configuracion\Establecimiento;
use App\Models\Patrimonio\Ambiente;

class Base extends Component
{
    use WithPagination;
    public $state, $trabajador, $salida, $urlFoto, $clase, $familia, $ubicacion, $anioCurso = 0, $areas; 
    public $equipo, $dni, $tipo;
    protected $paginationTheme = "bootstrap";

    public function mount(Request $request){
        if ($request->id) {
            $this->state = Equipo::leftjoin('log_equipos_inventariados as lr', function ($join) {
                    $join->on('lr.equipo_id', '=', 'log_equipos.id')
                        ->on('lr.estado', '=', DB::raw('1'));
                })
                ->leftjoin('rrhh_personas as p', 'lr.persona_id', '=', 'p.id')
                ->leftjoin('log_ambientes as a', 'log_equipos.ambiente_id', '=', 'a.id')
                ->select('log_equipos.id', 'equipo_id', 'lr.estado', 'anio', 'log_equipos.created_at as fecha', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno,', ', nombres) as nombrePersona"), 'p.id as IdPersonas', 'GRUPO_BIEN', 'CLASE_BIEN', 'FAMILIA_BIEN', 'SALIDA_ID', 'log_equipos.DESCRIPCION', 'CODIGO_ACTIVO', 'ESTADO_CONSERV', 'p.Id', 'MARCA', 'MODELO', 'NRO_SERIE', 'COLOR', 'log_equipos.OBSERVACIONES', 'ITEM_BIEN', 'log_equipos.ambiente_id', 'a.nombre as area')
                ->where('log_equipos.id', $request->id)
                ->orderby('lr.id', 'desc')
                ->first()->toArray();
            $data = Establecimiento::first();
            $this->anioCurso = $data->inventariado_anio;
           // $this->anioCurso = 2024;


            if ($this->state['ITEM_BIEN']) {
                $this->state['grupo'] = Grupo::where('grupo', $this->state['GRUPO_BIEN'])->first()->descripcion;
                $this->clase  = Clase::where('grupo', $this->state['GRUPO_BIEN'])->where('clase', $this->state['CLASE_BIEN'])->first();
                if ($this->clase) {
                    $this->clase = $this->clase->descripcion;
                }
                $data = Familia::where('grupo', $this->state['GRUPO_BIEN'])->where('clase', $this->state['CLASE_BIEN'])->where('familia', $this->state['FAMILIA_BIEN'])->first();
     
                if ($data) {
                    $this->familia  = $data->denominacion;
                }
            }
            
            $this->urlFoto = $this->state['GRUPO_BIEN'].$this->state['CLASE_BIEN'].$this->state['FAMILIA_BIEN'].'.'.$data->imagen; 
            $rutaCompleta = public_path('images/equipamiento/catalogo_equipos/'.$this->urlFoto);

            if (!file_exists($rutaCompleta)) {
                $this->urlFoto = 'sin_foto.jpeg';
            }

            if ($this->state['SALIDA_ID']) {
                $this->salida = EquipoSalida::join('users as u', 'u.id', 'log_equipos_salidas.created_by')->select('name', 'inicio', 'fin')->where('equipo_id', $request->id)->first();

            }
            $this->trabajador = $this->state['nombrePersona'];
            $this->areas = Ambiente::where('estado', 1)->get();
        }else{
            $this->state['id'] = 0;
        }
        
    }
    public function editar(Request $request){

        $equipo = Equipo::where('id', intval($this->state['id']))->update(
            [
                'MARCA' => $this->state['MARCA'],
                'MODELO' => $this->state['MODELO'],
                'NRO_SERIE' => $this->state['NRO_SERIE'],
                'OBSERVACIONES' => $this->state['OBSERVACIONES'],
                'COLOR' => $this->state['COLOR'],
                'ambiente_id' => $this->state['ambiente_id']
            ]
        );
        $this->dispatch('alert_info', ['mensaje' => 'Equipo actualizado Correctamente']);
    }
    public function render(Request $request)
    {
        
        return view('livewire.patrimonio.qr.base');
    }
}