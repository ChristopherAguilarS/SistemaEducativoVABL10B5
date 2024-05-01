<?php
namespace App\Livewire\Patrimonio\Qr;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
//--
use App\Models\RecursosHumanos\Persona;
use App\Models\Patrimonio\EquipoInventario;
use App\Models\Patrimonio\Equipo;
use App\Models\Configuracion\Establecimiento;

class Inventariar extends Component
{
    use WithPagination;
    protected $listeners = ['inventa', 'destroy'];
    public $tipo = 1, $estado = 1, $dni, $persona_id = 0, $nombres = '', $id_eq, $edicion, $titulo, $est;
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

                ->leftjoin('Personas as p', 'lr.persona_id', '=', 'p.Id')
                ->select('p.id as idp', 'ESTADO_CONSERV as estado', 'lr.id as edicion', DB::raw("CONCAT(p.apellidoPaterno,' ',p.apellidoMaterno, ', ',p.nombres) as nombres"))
                ->where('log_equipos.id', $this->id_eq)
                ->orderby('lr.id', 'desc')
                ->first();


            $this->edicion = $data->edicion;
            $this->estado = $data->estado;
            $this->dni = '';
            $this->persona_id = $data->idp;
            $this->nombres = $data->nombres;
            
        }else{
            $data = Equipo::where('id', $id)->first();
            if (isset($data->Id)) {
                $this->tipo = 2;
            }
            $this->titulo = 'Inventariar';
        }
        $this->dispatchBrowserEvent('show-form2');
    }
    public function buscar($id=''){
        try{
            $persona =Persona::select(DB::raw("(SELECT Top 1 dv.estado FROM rrhh_vinculo_detalle dv inner join rrhh_vinculo_laboral vl on dv.vinculo_laboral_id=vl.id where vl.persona_id=rrhh_personas.id order by estado desc) as estado_contrato"),'apellidoPaterno','apellidoMaterno','nombres','rrhh_personas.id')
                ->where('Personas.NumeroDocumento','=',$this->dni)
                ->first();
            if ($persona) {
                if ($persona->estado_contrato) {
                    $this->nombres=$persona->apellidoPaterno.' '.$persona->apellidoMaterno.', '.$persona->nombres;
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
    public function save(){
        try {
  
            $data = Establecimiento::find($this->est);    
     
            $anioCurso = $data->inventariado_anio;
            DB::beginTransaction();
            $det = EquipoInventario::where('equipo_id', $this->id_eq)->where('estado', 1)->first();

            if($this->tipo == 1){
                $sav2 = EquipoInventario::updateorcreate(['persona_id' => $det->persona_id, 'equipo_id' => $det->id, 'estado' => 1,'anio' => $anioCurso], ['tipo' => 3, 'motivo' => 0, 'equipo_id' => $det->id, 'origen_id' => $det->origen_id,'persona_id' => $det->persona_id,'estado' => 1,'anio' => $anioCurso,'created_at' => date('Y-m-d H:i:s'),'created_by' => auth()->user()->id]);
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Equipamiento desplazado correctamente']);
            }else{
                if(!isset($det->persona_id)){$pers = 0;}else{$pers = $det->persona_id;}
                $sav2 = EquipoInventario::updateorcreate(
                    ['equipo_id' => $this->id_eq, 'origen_id' =>$pers, 'persona_id' => $this->persona_id,'estado' => 1,'anio' => $anioCurso],
                    ['equipo_id' => $this->id_eq, 'origen_id' =>$pers, 'persona_id' => $this->persona_id,'estado' => 1,'anio' => $anioCurso, 'created_at' => date('Y-m-d H:i:s'),'IdUsuarioCrea' => auth()->user()->id]);
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Inventariado correctamente']);
            }  
        
                if (isset($det->id)) {
                    $det->estado = 0;
                    $det->save();
                }

            $equipo = Equipo::find($this->id_eq);
                $equipo->ESTADO_CONSERV = $this->estado;
            $equipo->save();

            
            $this->dispatchBrowserEvent('hide-form2');
            DB::commit();
            redirect()->route('qr/equipo', ['id' => $this->id_eq]);
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            if ($this->tipo == 2) {
                dd($th);
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'El Equipo seleccionado no tiene un trabajador asignado, debes desplazar el equipo.']);
            }
            $this->dispatchBrowserEvent('error');
        }        
    }
    public function save2(){
        try {

            DB::beginTransaction();
                $sav2 = EquipoInventario::where('Id', $this->edicion)->update(['persona_id' => $this->persona_id, 'created_at' => date('Y-m-d H:i:s')]);
                 $det = Equipo::find($this->id_eq);
                    $det->ESTADO_CONSERV = $this->estado;
                    $det->save();
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Inventariado Editado correctamente']);
                redirect()->route('qr/equipo', ['id' => $this->id_eq]);
                $this->dispatchBrowserEvent('hide-form2');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            $this->dispatchBrowserEvent('error');
        }        
    }
    public function delInv(){
        $this->dispatchBrowserEvent('delete',['id' => $this->edicion, 'titulo' => 'Eliminar Inventario', 'texto' => '¿Esta seguro del eliminar el inventario actual?']);     
    }
    public function destroy($id){
        $sav = EquipoInventario::destroy($id);
        $this->dispatchBrowserEvent(
            'alert', ['type' => 'success',  'message' => 'Inventario Eliminado Correctamente']);
        redirect()->route('qr/equipo', ['id' => $this->id_eq]);
        $this->dispatchBrowserEvent('hide-form2');
    }
    public function render(){
        return view('livewire.patrimonio.qr.inventariar');
    }
}