<?php
namespace App\Livewire\Patrimonio\Qr;
use Livewire\Component;
use Livewire\WithPagination;
//--
use Livewire\Attributes\On;
use App\Models\Patrimonio\Equipo;
class BuscarNumber extends Component
{
    use WithPagination;
    public $codigo, $existe = false, $buscar = false, $state = ['SIGA' => null, 'NRO_SERIE' => null, 'DESCRIPCION' => null], $dni, $nombres, $persona_id, $tipo = 1, $idBusqueda=0;
    #[On('buscarnum')]
    public function buscarnum(){
        $this->existe = false;
        $this->buscar = false;
        $this->state = ['SIGA' => null];
        $this->dni = '';
        $this->nombres = '';
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function buscarEq($id){
        try{
            if ($this->tipo == 1) {
                $persona =Equipo::where('CODIGO_ACTIVO', $this->codigo)->first();
            }elseif($this->tipo == 2){
                $persona =Equipo::where('NRO_SERIE', $this->codigo)->first();
            }else{
                $persona =Equipo::where('id', intval($this->codigo))->first();
            }
            
            if ($persona) {
                $this->existe = true;
                $this->idBusqueda = $persona->id;
                $this->state = $persona->toarray();
                $this->dispatch('alert_info', ['mensaje' => 'Equipo encontrado']);
            }else{
                $this->existe = false;
                $this->dispatch('alert_danger', ['mensaje' => 'Equipo no se encuentra registrado']);
            }
            $this->buscar = true;
        }catch(\Exception $e){
            dd($e);
            $this->dispatch('alert_danger', ['mensaje' => 'Equipo no se encuentra registrado']);
        }
    }
    function IrEq(){
        redirect()->route('qr/equipo', ['id' => $this->idBusqueda]);
    }
    public function render(){
        return view('livewire.patrimonio.qr.buscar-number');
    }
}