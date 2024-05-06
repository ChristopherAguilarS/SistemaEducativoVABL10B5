<?php

namespace App\Livewire\Patrimonio\PorAmbiente\Components;

use App\Models\Academico\Carrera;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Patrimonio\Equipo;
use App\Models\Patrimonio\Familia;
use App\Models\Patrimonio\EquipoInventario;
use App\Models\Patrimonio\Ambiente;
use DB;
use App\Http\Controllers\Rrhh\FuncionesCtrl;
use Livewire\WithFileUploads;
class NuevoIngreso extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $editar = false, $idDel, $idSel, $areas, $cargos, $documento, $nombres, $regimen, $regimenes, $condiciones, $idPers, $existe, $archivo;
    public $confirma = 0, $familia =0, $state = ['SIGA' => 0, 'ESTADO_CONSERV'=>1, 'tipo' => 1, 'ambiente_id' => 0], $inventario = [], $ambientes = [], $clasificacion, $nombre, $estadoFoto, $preview, $Foto, $urlFoto = null, $ambiente, $denominacion, $tipo=1, $filtro, $tituloModal, $seltab = 0, $idC = 0, $interno = [], $componentes = [], $tab = 1;
    #[On('nuevoIngreso')]
    public function onNuevo($id = 0){
        $this->idC = $id;
        $this->tipo =1;
        if ($id) {
            $this->editar = true;
            $this->software = ['software_id' => 1, 'compra' => date('Y-m-d'), 'vencimiento' => date('Y-m-d')];
            $this->tituloModal = 'Detalle de Equipo';
            $this->state = Equipo::find($id)->toArray();
            $this->tipo = 1;
            $this->familia = '';
        }else{
            $this->editar = false;
            $this->tituloModal = 'Nuevo ';
            $this->state = [
                'CODIGO_ACTIVO' => '', 
                'ambiente_id' => 0, 
                'SIGA' => 1, 
                'DESCRIPCION' => '', 
                'NRO_SERIE' => '', 
                'ESTADO_CONSERV' => 1, 
                'MARCA' => '', 
                'MODELO' => '', 
                'COLOR' => '',
                'ANCHO' => '',
                'LARGO' => '',
                'ALTO' => '',
                'EN_USO' => 1,
                'FECHA_COMPRA' => date('Y-m-d')
            ];
        }
        $this->confirma =0;
        $this->clasificacion = 0;
        $this->nombre = '';
        $this->urlFoto = 'sin_foto.jpeg';
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
            $grupo = substr($this->state['CODIGO_ACTIVO'], 0, 2);
            $clase = substr($this->state['CODIGO_ACTIVO'], 2, 2);
            $familia = substr($this->state['CODIGO_ACTIVO'], 4, 4);

            $equipo =Familia::where('grupo',$grupo)
                ->where('clase',$clase)
                ->where('familia',$familia)
                ->first();

            if($equipo){
                $this->familia = $equipo->denominacion;
                $this->confirma = 1;

                $this->urlFoto = $grupo.$clase.$familia.'.'.$equipo->imagen;
                $rutaCompleta = public_path('images/equipamiento/catalogo_equipos/'.$this->urlFoto);

                if (!file_exists($rutaCompleta)) {
                    $this->urlFoto = 'sin_foto.jpeg';
                }
            }else{
                $this->familia =0;
                $this->confirma =0;
                $this->dispatch('alert_danger', ['mensaje' => 'Código patrimonial no encontrado']);
            }
        }catch(\Exception $e){dd($e);
            $this->familia =0;
            $this->confirma =0;
            $this->dispatch('alert_danger', ['mensaje' => 'Código patrimonial no encontrado']);
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
    public function mount(){
        $this->ambientes = Ambiente::where('estado', 1)->get();
    }
    public function guardar(){
        if (!$this->state['SIGA']) {
            $this->state['CODIGO_ACTIVO'] = '';
        }else{
            $this->state['GRUPO_BIEN'] = substr($this->state['CODIGO_ACTIVO'], 0, 2);
            $this->state['CLASE_BIEN'] = substr($this->state['CODIGO_ACTIVO'], 2, 2);
            $this->state['FAMILIA_BIEN'] = substr($this->state['CODIGO_ACTIVO'], 4, 4);
            $this->state['ITEM_BIEN'] = substr($this->state['CODIGO_ACTIVO'], 8, 10);
        }
        $this->state['TIPO_ITEM'] = $this->tipo;
        if ($this->state['SIGA']) {
            $this->validate([
                'state.NRO_SERIE' => 'required|not_in:0',
                'state.DESCRIPCION' => 'required',
                'state.CODIGO_ACTIVO' => 'required',
                'state.ambiente_id' => 'required|not_in:0'
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
                    $sav = Equipo::where('id', $this->idC )->update(['DESCRIPCION' => $this->state['DESCRIPCION'], 'NRO_SERIE' => $this->state['NRO_SERIE'], 'ESTADO_CONSERV' => $this->state['ESTADO_CONSERV'], 'MARCA' => $this->state['MARCA'], 'MODELO' => $this->state['MODELO'], 'COLOR' => $this->state['COLOR'], 'ANCHO' => $this->state['ANCHO'], 'LARGO' => $this->state['LARGO'], 'ALTO' => $this->state['ALTO'], 'EN_USO' => $this->state['EN_USO'], 'FECHA_COMPRA' => $this->state['FECHA_COMPRA']]);
                }else{
                    $save = Equipo::create($this->state);
                    if ($save) {
                        if($this->idPers){
                            $save2 = EquipoInventario::create(['equipo_id' => $save->id, 'origen_id' => 0,'persona_id' => $this->idPers,'tipo' => 3,'motivo' => 0,'estado' => 1,'anio' => date('Y'), 'created_by' => auth()->user()->id,'created_at' =>date('Y-m-d H:i:s')]);
                        }                        
                    }
                }
                $this->dispatch('alert_info', ['mensaje' => 'Equipo Guardado Correctamente']);
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
                $this->dispatch('rTabla2');
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->dispatch('alert_info', ['mensaje' => 'Ocurrio un error']);
        }
    }
    public function render(){
        return view('livewire.patrimonio.por-ambiente.components.nuevo-ingreso');
    }
}
