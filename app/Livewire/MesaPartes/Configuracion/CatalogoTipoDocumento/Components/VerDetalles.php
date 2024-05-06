<?php
namespace App\Livewire\MesaPartes\Configuracion\CatalogoTipoDocumento\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\MesaPartes\CatalogoTipoDocumento;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $state = ['descripcion' =>'', 'estado' =>1], $catalogo, $tipo, $idDel;

    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        $this->editar = false;
        if($tipo == 1){
            $this->titulo = "Nuevo Catalogo de Tipo de Documento";
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Catalogo de Tipo de Documento";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Catalogo de Tipo de Documento";
        }
        if($id){
            $this->catalogo = CatalogoTipoDocumento::find($id);
            $this->state['descripcion'] = $this->catalogo->descripcion;
            $this->state['estado'] = $this->catalogo->estado;
            if($tipo == 3){
                $this->editar = $id;
            }
        }else{
            $this->state = ['descripcion' =>'', 'estado' =>1];
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
        $del1 = CatalogoTipoDocumento::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        $this->validate(['state.descripcion' => 'required', 'state.estado' => 'required']);
        if($this->editar){
            $this->catalogo->descripcion = $this->state['descripcion'];
            $this->catalogo->estado = $this->state['estado'];
            $this->catalogo->save();
            $this->dispatch('alert_info', ['mensaje' => 'Catalogo editado correctamente']);
        }else{
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $sav2 = CatalogoTipoDocumento::create($this->state);
            $this->dispatch('alert_info', ['mensaje' => 'Catalogo creado correctamente']);
        }
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.mesa-partes.configuracion.catalogo-tipo-documento.components.ver-detalles');
    }
}
