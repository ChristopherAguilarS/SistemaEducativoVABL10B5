<?php

namespace App\Livewire\Patrimonio\PorPersona\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\Persona;
use App\Models\Patrimonio\EquipoInventario;
use DB;
use App\Http\Controllers\Rrhh\FuncionesCtrl;
use Livewire\WithFileUploads;
class VerEquipamiento extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $accion = 2, $anio, $det = ['nombre' => '', 'area' => '', 'ambiente'=>''],$persona,$inventariados = [], $pendientes = [], $nombres, $dni,$state = ['IdPersona' =>0, 'tipo' => 2, 'IdEstablecimiento ' =>0], $inv = [],$num_sel = 0, $save = false, $persona_id;

    public function updatedaccion(){
        $this->num_sel = 0;
        $this->save = false;
        $this->inv = [];
    }
    #[On('verEquipamiento')]
    public function onNuevo($persona, $anio){
        $this->num_sel = 0;
        $this->save = false;
        $this->inv = [];
        $this->persona = $persona;
        $this->anio = $anio;
        $this->inventariados = [];
        $this->pendientes = [];
        $this->det =Persona::select(DB::raw("CONCAT(ApellidoPaterno, ' ', ApellidoMaterno,', ', Nombres) as nombre"))
                ->where('Id', $persona)
                ->first()->toarray();
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function buscar($id=''){
        try{
            $class = new FuncionesCtrl();
            $persona = $class->personaActivaByDoc($this->dni);

            if ($persona) {
                if ($persona->estado_contrato) {
                    $this->nombres=$persona->noms;
                    $this->persona_id=$persona->id;
                }else{
                    $this->nombres = '';
                    $this->persona_id = 0;
                    $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Trabajador no tiene contrato activo']);
                }
            }else{
                $this->nombres = '';
                $this->persona_id = 0;
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Trabajador no esta registrado en el sistema']);
            }
        }catch(\Exception $e){
            $this->nombres = '';
            $this->persona_id = 0;
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Trabajador no esta registrado en el sistema']);
        }
    }

   
    public function guardar(){
        if($this->accion == 1){
            if (count($this->inv) == 0) {
                $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Debes seleccionar un equipo.']);
            }else{
                try{
                    $sav = EquipoInventario::whereIn('equipo_id',array_values($this->inv))->where('persona_id', $this->persona)->update(['estado' =>0]);
                    foreach ($this->inv as $ar) {
                        if ($ar) {
                            $sav2 = EquipoInventario::updateorcreate(['equipo_id' => $ar, 'persona_id' => $this->persona_id, 'anio' => $this->anio], ['tipo' => 3, 'motivo' => 0, 'equipo_id' => $ar, 'origen_id' => $this->persona,'persona_id' => $this->persona_id,'estado' => 1,'anio' => $this->anio,'created_at' => date('Y-m-d H:i:s'), 'created_by' => auth()->user()->id]);
                            $this->save = $sav2->id;
                        }
                    }
                    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Equipamiento desplazado correctamente']);
                }catch(\Exception $e){dd($e);
                    $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Error al inventariar el equipo']);
                }
            }
        }else{
            try{
                $sav = EquipoInventario::whereIn('equipo_id',array_values($this->inv))->where('persona_id', $this->persona)->update(['estado' =>0]);
                foreach ($this->inv as $ar) {
                    if ($ar) {
                        $sav2 = EquipoInventario::updateorcreate(['equipo_id' => $ar,'persona_id' => $this->persona,'estado' => 1,'anio' => $this->anio], ['equipo_id' => $ar,'persona_id' => $this->persona,'estado' => 1,'anio' => $this->anio,'created_at' => date('Y-m-d H:i:s'), 'created_by' => auth()->user()->id]);
                    }
                }
                $this->num_sel = 0;
                $this->inv = [];
                $this->save = true;
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Inventariado correctamente']);
            }catch(\Exception $e){dd($e);
                $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Error al inventariar el equipo']);
            }
        }
    }
    public function render(){
        if (isset($this->persona)) {
            $data = EquipoInventario::join('log_equipos as e', 'e.id', 'log_equipos_inventariados.equipo_id')->select('e.id', 'e.DESCRIPCION as equipo', 'ESTADO_CONSERV as estado_eq', 'OBSERVACIONES', 'log_equipos_inventariados.estado', 'log_equipos_inventariados.anio', 'CODIGO_ACTIVO')->where('persona_id', $this->persona)->where('estado', 1)->orderby('equipo', 'asc')->get();
            $this->inventariados = $data->where('anio', $this->anio);
            $this->pendientes = $data->where('anio', '!=', $this->anio);
            $c = 0;
            foreach ($this->inv as $ar) {
                if ($ar) {
                    $c++;
                }
            }
            $this->num_sel = $c;
        }
        return view('livewire.patrimonio.por-persona.components.ver-equipamiento');
    }
}
