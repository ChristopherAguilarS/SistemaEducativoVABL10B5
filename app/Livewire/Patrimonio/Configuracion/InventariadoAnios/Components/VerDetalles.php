<?php
namespace App\Livewire\Patrimonio\Configuracion\InventariadoAnios\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Patrimonio\InventarioAnios;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $estado = 1, $anio, $inventario, $tipo, $idDel;

    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        $this->editar = false;
        if($tipo == 1){
            $this->titulo = "Apertura de Año";
            $this->estado = 1;
            $this->anio = '';
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Año";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Año";
        }
        if($id){
            $this->inventario = InventarioAnios::find($id);
            $this->estado = $this->inventario->estado;
            $this->anio = $this->inventario->anio;
            if($tipo == 3){
                $this->editar = $id;
            }
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('delAnio')]
    public function delAnio($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el año #'.($id), 'funcion' => 'brAnio']);
    }
    #[On('brAnio')]
    public function brAnio(){
        $del1 = InventarioAnios::where('anio', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        $this->validate(['anio' => 'required', 'estado' => 'required']);
        if($this->editar){
            $this->inventario->estado = $this->estado;
            $this->inventario->save();
            $this->dispatch('alert_info', ['mensaje' => 'Año editado correctamente']);
        }else{
            if($this->estado){
                $sav1 = InventarioAnios::where('estado', 1)->update(['estado' => 0]);
            }
            $sav2 = InventarioAnios::updateorcreate([
                'anio' => $this->anio
            ],[
                'anio' => $this->anio,
                'estado' => $this->estado
            ]);
            $this->dispatch('alert_info', ['mensaje' => 'Año aperturado correctamente']);
        }
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.patrimonio.configuracion.inventariado-anios.components.ver-detalles');
    }
}
