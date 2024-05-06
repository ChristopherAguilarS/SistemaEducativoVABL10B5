<?php
namespace App\Livewire\Patrimonio\Qr;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Patrimonio\Equipo;
use App\Models\Patrimonio\EquipoInventario;
use DB;
use App\Http\Controllers\Rrhh\FuncionesCtrl;
use App\Models\Configuracion\Establecimiento;
class Inventariar extends Component
{
    use WithPagination;

    public $tipo = 1, $estado = 1, $dni, $persona_id = 0, $nombres = '', $id_eq, $edicion, $titulo, $est, $editar, $idDel;
    #[On('inventa')]
    public function inventa($id, $edicion = 0){
        $this->id_eq = $id;
        $this->edicion = $edicion;
        if ($edicion) {
            $this->tipo = 2;
            $this->titulo = 'Edición de Inventariado';

            $data = Equipo::leftjoin('log_equipos_inventariados as lr', function ($join) {
                        $join->on('lr.equipo_id', '=', 'log_equipos.id')
                            ->on('lr.estado', '=', DB::raw('1'));
                    })

                ->leftjoin('rrhh_personas as p', 'p.id', 'lr.persona_id')
                ->select('p.id as idp', 'ESTADO_CONSERV as estado', 'lr.id as edicion', 'p.numeroDocumento', DB::raw("CONCAT(p.apellidoPaterno,' ',p.apellidoMaterno, ', ',p.nombres) as nombres"))
                ->where('log_equipos.id', $this->id_eq)
                ->orderby('lr.id', 'desc')
                ->first();

            $this->edicion = $data->edicion;
            $this->estado = $data->estado;
            $this->dni = $data->numeroDocumento;
            $this->persona_id = $data->idp;
            $this->nombres = $data->nombres;
            
        }else{
            $data = Equipo::where('id', $id)->first();
            if (isset($data->Id)) {
                $this->tipo = 2;
            }
            $this->titulo = 'Inventariar';
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    public function buscar($id=''){
        try{
            $class = new FuncionesCtrl();
            $persona = $class->personaActivaByDoc($this->dni);

            if ($persona) {
                $this->nombres = $persona->noms;
                $this->persona_id=$persona->id;
            }else{
                $this->nombres = '';
                $this->persona_id = 0;
                $this->dispatch('alert_info', ['mensaje' => 'Trabajador no esta registrado en el sistema']);
            }
        }catch(\Exception $e){
            $this->nombres = '';
            $this->persona_id = 0;
            $this->dispatch('alert_danger', ['mensaje' => 'Trabajador no esta registrado en el sistema']);
        }
    }
    public function save(){
        $this->validate([
            'persona_id' => 'required|not_in:0',
        ]);
        try {
            $data = Establecimiento::where('estado', 1)->first();    
            $anioCurso = $data->inventariado_anio;

            DB::beginTransaction();
            $det = EquipoInventario::where('equipo_id', $this->id_eq)->where('estado', 1)->first();
            if($this->tipo == 1){
                $sav2 = EquipoInventario::updateorcreate(['persona_id' => $det->persona_id, 'equipo_id' => $det->id, 'estado' => 1,'anio' => $anioCurso], ['equipo_id' => $det->id, 'origen_id' => $det->origen_id,'persona_id' => $det->persona_id,'estado' => 1,'anio' => $anioCurso,'created_at' => date('Y-m-d H:i:s'),'created_by' => auth()->user()->id]);
                $this->dispatch('alert_info', ['mensaje' => 'Equipamiento desplazado correctamente']);
            }else{
                if(!isset($det->persona_id)){$pers = 0;}else{$pers = $det->persona_id;}
                $sav2 = EquipoInventario::updateorcreate(
                    ['equipo_id' => $this->id_eq, 'origen_id' =>$pers, 'persona_id' => $this->persona_id,'estado' => 1,'anio' => $anioCurso],
                    ['equipo_id' => $this->id_eq, 'origen_id' =>$pers, 'persona_id' => $this->persona_id,'estado' => 1,'anio' => $anioCurso, 'created_at' => date('Y-m-d H:i:s'),'created_by' => auth()->user()->id]);
                $this->dispatch('alert_info', ['mensaje' => 'Inventariado correctamente']);
            }  
            if (isset($det->id)) {
                $det->estado = 0;
                $det->save();
            }
            $equipo = Equipo::find($this->id_eq);
                $equipo->ESTADO_CONSERV = $this->estado;
            $equipo->save();            
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            DB::commit();
            redirect()->route('qr/equipo', ['id' => $this->id_eq]);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            if ($this->tipo == 2) {
                dd($th);
                $this->dispatch('alert_danger', ['mensaje' => 'El Equipo seleccionado no tiene un trabajador asignado, debes desplazar el equipo.']);
            }
            $this->dispatchBrowserEvent('error');
        }        
    }
    public function save2(){
        try {

            DB::beginTransaction();
                $sav2 = EquipoInventario::where('id', $this->edicion)->update(['persona_id' => $this->persona_id, 'created_at' => date('Y-m-d H:i:s')]);
                 $det = Equipo::find($this->id_eq);
                    $det->ESTADO_CONSERV = $this->estado;
                    $det->save();
                    $this->dispatch('alert_info', ['mensaje' => 'Inventariado Editado correctamente']);
                redirect()->route('qr/equipo', ['id' => $this->id_eq]);
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un error inesperado.']);
        }        
    }
    #[On('delInv')]
    public function delInv($id =0){
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el inventario #'.($id), 'funcion' => 'brInv']);
    }
    #[On('brInv')]
    public function brCat(){
        $sav = EquipoInventario::destroy($this->edicion);
        redirect()->route('qr/equipo', ['id' => $this->id_eq]);
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function render(){
        return view('livewire.patrimonio.qr.inventariar');
    }
}