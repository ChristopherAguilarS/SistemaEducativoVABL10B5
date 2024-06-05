<?php
namespace App\Livewire\Patrimonio\Configuracion\CatalogoPabellones\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Patrimonio\CatalogoPabellon;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $state = ['descripcion' =>'', 'numero_pisos' =>1, 'area' =>'', 'area_techada' =>'', 'anio_construccion' =>'', 'estado_conservacion' =>1, 'estado' =>1], $catalogo, $tipo, $idDel;

    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        $this->editar = false;
        if($tipo == 1){
            $this->titulo = "Nuevo Catalogo de Pabellones";
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Catalogo de Pabellones";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Catalogo de Pabellones";
        }
        if($id){
            $this->catalogo = CatalogoPabellon::find($id);
            $this->state['descripcion'] = $this->catalogo->descripcion;
            $this->state['numero_pisos'] = $this->catalogo->numero_pisos;
            $this->state['area'] = $this->catalogo->area;
            $this->state['area_techada'] = $this->catalogo->area_techada;
            $this->state['anio_construccion'] = $this->catalogo->anio_construccion;
            $this->state['estado_conservacion'] = $this->catalogo->estado_conservacion;
            $this->state['estado'] = $this->catalogo->estado;
            if($tipo == 3){
                $this->editar = $id;
            }
        }else{
            $this->state = ['descripcion' =>'', 'numero_pisos' =>1, 'area' =>NULL, 'area_techada' =>NULL, 'anio_construccion' =>NULL, 'estado_conservacion' =>1, 'estado' =>1];
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('delCat')]
    public function delCat($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el catalogo #'.($id), 'funcion' => 'brCat']);
    }
    #[On('brCat')]
    public function brCat(){
        $del1 = CatalogoPabellon::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        $this->validate(['state.descripcion' => 'required', 'state.estado' => 'required']);
        if($this->editar){
            $this->catalogo->descripcion = $this->state['descripcion'];
            $this->catalogo->numero_pisos = $this->state['numero_pisos'];
            $this->catalogo->area = $this->state['area'];
            $this->catalogo->area_techada = $this->state['area_techada'];
            $this->catalogo->anio_construccion = $this->state['anio_construccion'];
            $this->catalogo->estado_conservacion = $this->state['estado_conservacion'];
            $this->catalogo->estado = $this->state['estado'];
            $this->catalogo->updated_by = auth()->user()->id;
            $this->catalogo->updated_at = date('Y-m-d H:i:s');
            $this->catalogo->save();
            $this->dispatch('alert_info', ['mensaje' => 'Catalogo editado correctamente']);
        }else{
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $sav2 = CatalogoPabellon::create($this->state);
            $this->dispatch('alert_info', ['mensaje' => 'Catalogo creado correctamente']);
        }
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.patrimonio.configuracion.catalogo-pabellones.components.ver-detalles');
    }
}
