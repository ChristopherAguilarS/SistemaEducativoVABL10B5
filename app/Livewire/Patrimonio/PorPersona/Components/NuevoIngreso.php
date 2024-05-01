<?php

namespace App\Livewire\Patrimonio\PorPersona\Components;

use App\Models\Academico\Carrera;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Patrimonio\Equipo;
use App\Models\Patrimonio\CatalogoEquipo;
use App\Models\Patrimonio\EquipoInventario;
use App\Models\RecursosHumanos\CatalogoArea;
use DB;
use App\Http\Controllers\Rrhh\FuncionesCtrl;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
class NuevoIngreso extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $editar = false, $idDel, $idSel, $areas, $cargos, $documento, $nombres, $regimen, $regimenes, $condiciones, $idPers, $existe, $archivo;
    public $confirma = 0, $familia =0, $state = ['SIGA' => 0, 'ESTADO_CONSERV'=>1, 'tipo' => 1, 'area_id' => 0], $inventario = [], $ambientes = [], $clasificacion, $nombre, $area, $estadoFoto, $preview, $Foto, $urlFoto = 'CatalogoEquipos/0', $ambiente, $denominacion, $tipo=1, $filtro, $tituloModal, $seltab = 0, $idC = 0, $interno = [], $componentes = [], $tab = 1;
    #[On('nuevoIngreso')]
    public function onNuevo($id = 0){
        $this->idC = $id;
        $this->tipo =1;
        if ($id) {
            $this->editar = true;
            $this->software = ['software_id' => 1, 'compra' => date('Y-m-d'), 'vencimiento' => date('Y-m-d')];
            
            $this->tituloModal = 'Detalle de ';
            $this->state = Equipo::where('id', $id)->first()->toArray();
        }else{
            $this->editar = false;
            $this->tituloModal = 'Nuevo ';
        }
        $this->familia =0;
        $this->confirma =0;
        $this->state['CODIGO_ACTIVO'] = '';
        $this->state['IdAmbientes'] = '';
        $this->clasificacion = 0;
        $this->nombre = '';
        $this->state['SIGA'] =1;
        
        if ($this->seltab) {
            $this->buscar2($this->seltab);
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('ver')]
    public function verDetalle($id = 0){
        $this->idSel = $id;
        $this->titulo = "Detalle de Trabajador";
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('eliminar')]
    public function eliminar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el nivel con codigo Nro.'.$id, 'funcion' => 'brNivel']);
    }
    #[On('brNivel')]
    public function brNivel(){
        $sav = Carrera::find($this->idDel);
        $sav->delete();
        $this->dispatch('rTabla');
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function buscar($id){
        try{
            if ($id==1) {
                $grupo = substr($this->state['CODIGO_ACTIVO'], 0, 2);
                $clase = substr($this->state['CODIGO_ACTIVO'], 2, 2);
                $familia = substr($this->state['CODIGO_ACTIVO'], 4, 4);

                $equipo =CatalogoEquipo::where('grupo',$grupo)
                    ->where('clase',$clase)
                    ->where('familia',$familia)
                    ->first();
            }else{
                $grupo = substr($this->state['CODIGO_SUPERIOR'], 0, 2);
                $clase = substr($this->state['CODIGO_SUPERIOR'], 2, 2);
                $familia = substr($this->state['CODIGO_SUPERIOR'], 4, 4);
                $equipo =Equipo::where('CODIGO_ACTIVO', $this->state['CODIGO_SUPERIOR'])
                    ->orWhere('Id', $this->state['CODIGO_SUPERIOR'])
                    ->first();
                $des =CatalogoEquipo::where('grupo',$grupo)
                    ->where('clase',$clase)
                    ->where('familia',$familia)
                    ->first();
            }

            if($equipo){
                if ($id==1) {
                    $this->familia = $equipo->descripcion;
                    $this->confirma = 1;
                    $this->urlFoto = 'CatalogoEquipos/'.$grupo.$clase.$familia;
                }else{
                    if($equipo->DESCRIPCION){
                        $this->denominacion = $equipo->DESCRIPCION;
                    }else{
                        $this->denominacion = $des->descripcion;
                    }
                }
            }else{
                $this->familia =0;
                $this->confirma =0;
                $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Código patrimonial no encontrado']);
            }
        }catch(\Exception $e){dd($e);
            $this->familia =0;
            $this->confirma =0;
            $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Código patrimonial no encontrado']);
        }
    }
    public function buscar2($id =0){
        $this->idPers = 0;
        $class = new FuncionesCtrl();
        if($id){
            $data = $class->personaActivaById($id);
        }else{
            $data = $class->personaActivaByDoc($this->documento);
        }
        if($data){
            if($data->estado == 1){
                $this->dispatch('alert_danger', ['mensaje' => 'Trabaja ya tiene un contrato vigente']);
            }else{
                $this->nombres = $data->noms;
                $this->idPers = $data->id;
                $this->dispatch('alert_info', ['mensaje' => 'Trabajador Encontrado']);
            }
        }else{
            $this->nombres = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Trabajador no Encontrado']);
        }
    }
    public function guardar(){
        if (!$this->state['SIGA']) {
            $this->state['CODIGO_ACTIVO'] = '';
        }
        $this->state['TIPO_ITEM'] = $this->tipo;
        if ($this->state['SIGA']) {
            $this->validate([
                'state.NRO_SERIE' => 'required|not_in:0',
                'state.DESCRIPCION' => 'required',
                'state.CODIGO_ACTIVO' => 'required'
            ]);
        }else{
            $this->validate([
                //'state.NRO_SERIE' => 'required|not_in:0',
                'state.DESCRIPCION' => 'required'
            ]);
        }
        $this->state['DESCRIPCION'] = strtoupper($this->state['DESCRIPCION']);
        $this->state['TIPO_ITEM'] = $this->tipo;
        try{
            DB::beginTransaction();
                if ($this->idC) {
                    $sav = Equipo::where('id', $this->idC )->update(['DESCRIPCION' => $this->state['DESCRIPCION'], 'NRO_SERIE' => $this->state['NRO_SERIE'], 'ESTADO_CONSERV' => $this->state['ESTADO_CONSERV'], 'MARCA' => $this->state['MARCA'], 'MODELO' => $this->state['MODELO'], 'COLOR' => $this->state['COLOR']]);
                }else{
                    $save = Equipo::create($this->state);
                    if ($save) {
                        $save2 = EquipoInventario::create(['equipo_id' => $save->Id, 'area_id' => $this->state['area_id'],'origen_id' => 0,'persona_id' => $this->idPers,'tipo' => 3,'motivo' => 0,'estado' => 1,'anio' => date('Y'), 'created_by' => auth()->user()->id,'created_at' =>date('Y-m-d H:i:s')]);
                    }
                }
                $this->dispatch('alert_info', ['mensaje' => 'Equipo Guardado Correctamente']);
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
                $this->dispatch('rTabla');
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->dispatch('alert_info', ['mensaje' => 'Ocurrio un error']);
        }
    }
    public function render(){
        $this->areas = CatalogoArea::where('estado', 1)->get();
        return view('livewire.patrimonio.por-persona.components.nuevo-ingreso');
    }
}
