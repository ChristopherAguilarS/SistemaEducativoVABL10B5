<?php

namespace App\Livewire\Patrimonio\PorAmbiente\Components;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Patrimonio\ComisionInventariado;
use App\Http\Controllers\Rrhh\FuncionesCtrl;
use DB;
use Livewire\WithFileUploads;
class VerComision extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $anio, $trabajadores, $nombres, $dni,$state = ['IdPersona' =>0, 'tipo' => 2, 'IdEstablecimiento ' =>0], $persona_id;
    #[On('verComision')]
    public function verComision(){
        $this->nombres = '';
        $this->dni = '';
        $this->dispatch('verModal', ['id' => 'form3', 'accion' => 'show']);
    }
    public function buscar(){
        $class = new FuncionesCtrl();
        $data = $class->personaActivaByDoc($this->dni);
        if($data){
            $this->nombres = $data->noms;
            $this->persona_id = $data->id;
            $this->dispatch('alert_info', ['mensaje' => 'Trabajador Encontrado']);
        }else{
            $this->nombres = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Trabajador no Encontrado']);
        }
    }
    public function del($id){
        $sav = ComisionInventariado::find($id)->delete();
        $this->dispatch('alert_info', ['mensaje' => 'Personal Inventariador Retirado Correctamente']);
    }
    public function save(){
        $this->validate(['nombres' => 'required']);
        $this->state['anio'] = $this->anio;
        $sav = ComisionInventariado::updateorcreate(
            ['personaNombres'=>$this->nombres, 'anio' => $this->state['anio']], 
            ['persona_id'=>$this->persona_id, 'personaDni'=>$this->dni, 'personaNombres'=>$this->nombres, 'anio' => $this->state['anio'], 'tipo' => $this->state['tipo'], 'created_by' => auth()->user()->id, 'created_at' =>date('Y-m-d H:i:s')]);
        $this->dispatch('alert_info', ['mensaje' => 'Personal Inventariador Ingresado Correctamente']);
        }
    public function mount(){
        $this->anio = date('Y');
    }
    public function render(){
        $this->trabajadores = ComisionInventariado::select('tipo', 'personaNombres', 'id')->where('anio', $this->anio)->get();
        return view('livewire.patrimonio.por-ambiente.components.ver-comision');
    }
}
