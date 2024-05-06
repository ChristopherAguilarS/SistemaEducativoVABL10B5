<?php
namespace App\Livewire\Patrimonio\Ambientes\Components;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\Patrimonio\CatalogoTipoAmbiente;
use App\Models\Patrimonio\CatalogoUbicacion;
use App\Models\Patrimonio\CatalogoUsoAmbiente;
use App\Models\Patrimonio\CatalogoCondicion;
use App\Models\Patrimonio\CatalogoPiso;
use App\Models\Patrimonio\Ambiente;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = ['nombre' => '', 'descripcion' => '', 'catalogo_tipo_ambiente_id' => 0, 'catalogo_ubicacion_id' => 0, 'catalogo_uso_ambiente_id' => 0, 'catalogo_condicion_id' => 0, 'aforo' => '', 'area' => '', 'pabellon' =>'', 'catalogo_piso_id'=>0, 'observaciones'=>''];
    public $tipos, $idDel, $ubicaciones, $usos, $condiciones, $aforo, $area, $pabellon, $pisos, $observaciones, $tipo, $editar, $catalogo;

    public function mount(){
        $this->tipos = CatalogoTipoAmbiente::where('estado', 1)->get()->toArray();
        $this->ubicaciones = CatalogoUbicacion::where('estado', 1)->get()->toArray();
        $this->usos = CatalogoUsoAmbiente::where('estado', 1)->get()->toArray();
        $this->condiciones = CatalogoCondicion::where('estado', 1)->get()->toArray();
        $this->pisos = CatalogoPiso::where('estado', 1)->get()->toArray();
    }
    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        $this->editar = false;
        if($tipo == 1){
            $this->titulo = "Nuevo Ambiente";
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Ambiente";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Ambiente";
        }
        if($id){
            $this->catalogo = Ambiente::find($id);
            $this->state = [
                'nombre' => $this->catalogo->nombre, 
                'descripcion' => $this->catalogo->descripcion, 
                'catalogo_tipo_ambiente_id' => $this->catalogo->catalogo_tipo_ambiente_id, 
                'catalogo_ubicacion_id' => $this->catalogo->catalogo_ubicacion_id, 
                'catalogo_uso_ambiente_id' => $this->catalogo->catalogo_uso_ambiente_id, 
                'catalogo_condicion_id' => $this->catalogo->catalogo_condicion_id,
                'aforo' => $this->catalogo->aforo, 
                'area' => $this->catalogo->area, 
                'pabellon' => $this->catalogo->pabellon,
                'catalogo_piso_id' => $this->catalogo->catalogo_piso_id,
                'observaciones' => $this->catalogo->observaciones,
                'estado' => $this->catalogo->estado
            ];
            if($tipo == 3){
                $this->editar = $id;
            }
        }else{
            $this->state = [
                'nombre' =>'', 
                'descripcion' =>'', 
                'catalogo_tipo_ambiente_id' =>0, 
                'catalogo_ubicacion_id' =>0, 
                'catalogo_uso_ambiente_id' =>0, 
                'catalogo_condicion_id' =>0, 
                'aforo' =>'', 
                'area' =>'', 
                'pabellon' =>'', 
                'catalogo_piso_id' =>0, 
                'observaciones' =>'',
                'estado' =>1
            ];
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('delAmb')]
    public function delAmb($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el Ambiente #'.($id), 'funcion' => 'brAmb']);
    }
    #[On('brAmb')]
    public function brCat(){
        $del1 = Ambiente::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        if($this->editar){
                $this->catalogo->nombre = $this->state['nombre']; 
                $this->catalogo->descripcion = $this->state['descripcion']; 
                $this->catalogo->catalogo_tipo_ambiente_id = $this->state['catalogo_tipo_ambiente_id']; 
                $this->catalogo->catalogo_ubicacion_id = $this->state['catalogo_ubicacion_id']; 
                $this->catalogo->catalogo_uso_ambiente_id = $this->state['catalogo_uso_ambiente_id']; 
                $this->catalogo->catalogo_condicion_id = $this->state['catalogo_condicion_id']; 
                $this->catalogo->aforo = $this->state['aforo']; 
                $this->catalogo->area = $this->state['area']; 
                $this->catalogo->pabellon = $this->state['pabellon']; 
                $this->catalogo->catalogo_piso_id = $this->state['catalogo_piso_id']; 
                $this->catalogo->observaciones = $this->state['observaciones']; 
                $this->catalogo->estado = $this->state['estado']; 
                $this->catalogo->updated_by = auth()->user()->id;
                $this->catalogo->updated_at = date('Y-m-d H:i:s');
                $this->catalogo->save();
        }else{
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $eq = Ambiente::create($this->state);
        }
        
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
        $this->dispatch('alert_info', ['mensaje' => 'Equipo Añadido Correctamente']);
    }
    public function render(){
        return view('livewire.patrimonio.ambientes.components.ver-detalles');
    }
}
