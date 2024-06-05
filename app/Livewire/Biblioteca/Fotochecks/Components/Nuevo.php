<?php
namespace App\Livewire\Biblioteca\Fotochecks\Components;

use App\Models\Biblioteca\Carne;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Http\Controllers\MesaPartes\FuncionesCtrl;
class Nuevo extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $state = ['tipo' =>1, 'documento' =>'', 'nombres' => '', 'periodo'=>0, 'etiqueta' => ''], $entrega = ['fecha' => null, 'hora' => null, 'observaciones' => ''], $idSel;

    #[On('nuevo')]
    public function nuevo(){
        $this->state = ['tipo' => 1, 'documento' => '', 'nombres' => '', 'periodo'=>date('Y'), 'etiqueta' => '', 'persona_id' =>0];
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    public function buscar(){
        $class = new FuncionesCtrl();
        $data = $class->remitenteDoc($this->state['tipo'], $this->state['documento']);
        if($data){
            $this->state['nombres'] = $data->nombres;
            $this->state['persona_id'] = $data->id;
            $this->dispatch('alert_info', ['mensaje' => 'Persona Encontrada']);
        }else{
            $this->dispatch('alert_danger', ['mensaje' => 'Persona No Encontrada']);
        }
    }
    public function guardar(){
        $this->validate(['state.tipo' => 'required', 'state.documento' => 'required', 'state.periodo' => 'required', 'state.etiqueta' => 'required']);
        $sav = Carne::updateorcreate([
            'tipo' => $this->state['tipo'],
            'periodo' => $this->state['periodo'],
            'documento' => $this->state['documento']
        ],[
            'tipo' => $this->state['tipo'],
            'documento' => $this->state['documento'],
            'persona_id'=>$this->state['persona_id'],
            'nombres' => $this->state['nombres'],
            'periodo' => $this->state['periodo'],
            'etiqueta' => $this->state['etiqueta'],
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);        
        $this->dispatch('alert_info', ['mensaje' => 'Carné generado correctamente']);
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.biblioteca.fotochecks.components.nuevo');
    }
}
