<?php
namespace App\Livewire\MesaPartes\RegistroDocumento;
use App\Http\Controllers\MesaPartes\FuncionesCtrl;
use Livewire\Component;
use App\Models\MesaPartes\CatalogoTipoDocumento;
use App\Models\MesaPartes\Expediente;
use App\Models\RecursosHumanos\CatalogoArea;
use App\Models\RecursosHumanos\Persona;
use Livewire\WithFileUploads;
class Filtro extends Component{
    use WithFileUploads;
    public $tipos, $state = [], $pdf, $areas, $personas, $guardado = false, $numero;
    public function buscar(){
        $class = new FuncionesCtrl();
        $data = $class->remitenteDoc($this->state['tipo_remitente'], $this->state['remitente_documento']);
        if($data){
            $this->state['remitente_nombre'] = $data->nombres;
            $this->state['remitente_id'] = $data->id;
            $this->dispatch('alert_info', ['mensaje' => 'Remitente Encontrado']);
        }else{
            $this->dispatch('alert_danger', ['mensaje' => 'Remitente No Encontrado']);
        }
    }
    public function correlativo(){
        $num = Expediente::max('correlativo');
        if($num){
            $this->numero = $num+1;
        }else{
            $this->numero = 1;
        }
    }
    public function mount(){
        $this->correlativo();
        $this->limpiar();
    }
    public function updatedStateCatalogoAreaId($id){
        $this->personas = Persona::join('rrhh_vinculo_laboral as vl', 'rrhh_personas.id', 'vl.persona_id')
            ->select('rrhh_personas.id', 'apellidoPaterno', 'apellidoMaterno', 'nombres')
            ->where('catalogo_area_id', $id)->get()->toArray();
    }
    public function limpiar(){
        $this->guardado = false;
        $this->correlativo();
        $this->state = [
            'catalogo_tipo_documento_id' => 0,
            'folios' => '',
            'asunto' =>'',
            'tipo_remitente' => 1,
            'catalogo_area_id' => 0,
            'persona_id'=>0,
            'remitente_id' => 0,
            'remitente_documento' => '',
            'remitente_nombre' => '',
            'correo' => '',
            'telefono' => '',
        ];
    }
    public function guardar(){
        if($this->guardado){
            $this->dispatch('info', ['mensaje' => 'Expediente Guardado, Nro:'.$this->guardado]);
        }else{
            $this->validate([
                'state.remitente_documento' => 'required',
                'state.remitente_nombre' => 'required',
                'state.folios' => 'required',
                'state.asunto' => 'required',
                'state.catalogo_tipo_documento_id' => 'required|not_in:0',
                'state.catalogo_area_id' => 'required|not_in:0',
                'state.persona_id' => 'required|not_in:0',
                'numero' => 'required|not_in:0',
            ]);
            $existe = Expediente::where('correlativo', $this->numero)->first();
            if($existe){
                $this->dispatch('info', ['mensaje' => 'Correlativo #'.$this->numero.", ya existe."]);
            }else{
                $this->state['estado'] = 0;
                $this->state['correlativo'] = $this->numero;
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d H:i:s');
                $sav = Expediente::Create($this->state);
                if($this->pdf){
                    $ruta = 'pdf/expedientes/';
                    $nombre = $sav->id.'.pdf';
                    $this->pdf->storeAs($ruta, $nombre, 'public');
                }
                $this->guardado = $sav->id;
                $this->dispatch('info', ['mensaje' => 'Expediente Guardado, Nro:'.$this->numero]);
            }
            
            
        }
        
    }
    public function render(){
        $this->tipos = CatalogoTipoDocumento::where('estado', 1)->get();
        $this->areas = CatalogoArea::where('estado', 1)->get();
        return view('livewire.mesa-partes.registro-documento.filtro');
    }
}