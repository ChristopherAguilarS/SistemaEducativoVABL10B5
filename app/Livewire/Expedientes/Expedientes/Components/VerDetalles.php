<?php
namespace App\Livewire\Expedientes\Expedientes\Components;

use App\Models\RecursosHumanos\Persona;
use App\Models\RecursosHumanos\CatalogoArea;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\MesaPartes\Expediente;
use App\Models\Patrimonio\CatalogoUbicacion;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $correlativo, $estado, $tipo, $observaciones, $areas, $personas, $area, $persona, $expediente, $fecha_recibido, $hora_recibido;
    public function updatedArea($id){
        $this->personas = Persona::join('rrhh_vinculo_laboral as vl', 'rrhh_personas.id', 'vl.persona_id')
            ->select('rrhh_personas.id', 'apellidoPaterno', 'apellidoMaterno', 'nombres')
            ->where('catalogo_area_id', $id)->get()->toArray();
    }
    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        
        $this->expediente = Expediente::find($id);
        if(!$tipo){
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
            $this->titulo = "Detalle de Expediente";
            if($tipo == 0){
                $this->estado = "PENDIENTE";
            }elseif($tipo == 1){
                $this->estado = "ATENDIDO";
                $this->areas = CatalogoArea::where('estado', 1)->get()->toArray();
            }elseif($tipo == 2){
                $this->estado = "DERIVADO";
            }elseif($tipo == 3){
                $this->estado = "DENEGADO";
            }
            $this->correlativo = $this->expediente->correlativo;
            $this->observaciones = $this->expediente->observaciones;
            $this->fecha_recibido = date('Y-m-d', strtotime($this->expediente->created_at));
            $this->hora_recibido = date('h:i a', strtotime($this->expediente->created_at));
        }else{
            if($this->expediente->estado == 2){
                $this->dispatch('alert_danger', ['mensaje' => 'El expediente ya fue Atendido']);
            }elseif($this->expediente->estado == 4){
                $this->dispatch('alert_danger', ['mensaje' => 'El expediente ya fue denegado']);
            }else{
                if($tipo == 1){
                    $this->titulo = "Atender Documento";
                    $this->estado = "ATENDER";
                }elseif($tipo == 2){
                    $this->titulo = "Derivar Documento";
                    $this->estado = "DERIVAR";
                    $this->areas = CatalogoArea::where('estado', 1)->get()->toArray();
                }elseif($tipo == 3){
                    $this->titulo = "Denegar Documento";
                    $this->estado = "DENEGAR";
                }
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
            }
        }
    }
    #[On('delCat')]
    public function delCat($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el catalogo #'.($id), 'funcion' => 'brCat']);
    }
    #[On('brCat')]
    public function brCat(){
        $del1 = CatalogoUbicacion::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        if($this->tipo == 1){
            $this->expediente ->estado=1;
            $this->expediente ->observaciones=$this->observaciones;
            $this->expediente ->save();
            $this->dispatch('alert_info', ['mensaje' => 'Expediente atendido correctamente']);
        }elseif($this->tipo == 2){
            $copia = $this->expediente->replicate();
            $this->expediente->estado=3;
            $this->expediente->persona_id=$this->persona;
            $this->expediente->catalogo_area_id = $this->area;
            $this->expediente ->observaciones=$this->observaciones;
            $this->expediente ->save();
            $copia->origen_id = $this->documento;
            $copia->estado = 2;
            $copia->created_by = auth()->user()->id;
            $copia->created_at = date('Y-m-d H:i:s');
            $copia->save();
            
            $this->dispatch('alert_info', ['mensaje' => 'Expediente derivado correctamente']);
        }elseif($this->tipo == 3){
            $this->expediente ->estado=4;
            $this->expediente ->observaciones=$this->observaciones;
            $this->expediente ->save();
            $this->dispatch('alert_info', ['mensaje' => 'Expediente denegado correctamente']);
        }else{
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $sav2 = CatalogoUbicacion::create($this->state);
            $this->dispatch('alert_info', ['mensaje' => 'Catalogo creado correctamente']);
        }
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.expedientes.expedientes.components.ver-detalles');
    }
}
