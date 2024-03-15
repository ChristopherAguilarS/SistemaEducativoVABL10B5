<?php
namespace App\Livewire\FinancieroContable\Compras\Pedidos;
use Livewire\Component;
use DB;
use App\Models\FinancieroContable\Tarea;
use App\Models\FinancieroContable\PedidoDetalleTemp;
use Livewire\Attributes\On;
class EditarItem extends Component{
    public $titulo, $state = ['tarea_id' => 0], $editar = false, $ver = 0, $idSel, $nomItem, $partidas, $titulos, $local_id, $pedido_id;
    #[On('editarItem')]
    public function ver($arr, $alm, $ver){
        $this->ver = $ver;
        $this->idSel = $arr['id'];
        $this->state = $arr;
        $this->partidas = [];
        $this->nomItem = $arr['nom'];
        $this->partidas = Tarea::get();
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function guardar() {
        $this->validate(['state.tarea_id' => 'required|not_in:0', 'state.cantidad' => 'required|not_in:0']);
        try{
            DB::beginTransaction();
            if($this->ver == 1){
                $sav = PedidoDetalleTemp::find($this->state['id']);
                    $sav->cantidad = $this->state['cantidad'];
                    $sav->precio = $this->state['precio'];
                    $sav->tarea_id = $this->state['tarea_id'];
                $sav->save();
                $this->dispatch('rTabItems');
            }else{
                $this->dispatch('savItem', $this->state);
            } 
            DB::commit();
            $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un Error']);
        }
    }
    public function render() {
        return view('livewire.financiero-contable.compras.pedidos.editar-item');
    }
}
