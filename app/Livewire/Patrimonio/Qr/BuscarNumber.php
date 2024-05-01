<?php
namespace App\Livewire\Patrimonio\Qr;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
//--
use App\Models\RecursosHumanos\Persona;
use App\Models\Patrimonio\EquipoInventario;
use App\Models\Patrimonio\Equipo;
class BuscarNumber extends Component
{
    use WithPagination;
    protected $listeners = ['buscarnum'];
    public $codigo, $existe = false, $buscar = false, $state = ['SIGA' => null, 'NRO_SERIE' => null, 'DESCRIPCION' => null], $dni, $nombres, $persona_id, $tipo = 1, $idBusqueda=0;
    public function buscarnum(){
        $this->existe = false;
        $this->buscar = false;
        $this->state = ['SIGA' => null];
        $this->dni = '';
        $this->nombres = '';

        $this->dispatchBrowserEvent('show-form3');
    }
    public function buscar(){
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
                $this->idBusqueda = $persona->Id;
                $this->state = $persona->toarray();
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Equipo encontrado']);
            }else{
                $this->existe = false;
                $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Equipo no se encuentra registrado']);
            }
            $this->buscar = true;
        }catch(\Exception $e){
            dd($e);
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Equipo no se encuentra']);
        }
    }
    function IrEq(){
        redirect()->route('qr/equipo', ['id' => $this->idBusqueda]);
    }
    public function buscar2(){
        try{
            $persona =Persona::select(DB::raw("(SELECT Top 1 dv.estado FROM rrhh_vinculo_detalle dv inner join rrhh_vinculo_laboral vl on dv.vinculo_laboral_id=vl.id where vl.persona_id=rrhh_personas.id order by estado desc) as estado_contrato"),'apellidoPaterno','apellidoMaterno','nombres','rrhh_personas.id')
                ->where('RELPersonasTiposDocumentos.Numero','=',$this->dni)
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
    function save(){
        if (!$this->dni) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Debes ingresar un trabajador valido.']);
        }elseif (!$this->state['NRO_SERIE']) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Debes ingresar una serie valida.']);
        }else{
            try {
                DB::beginTransaction();
                if (!$this->state['SIGA']) {
                    $this->state['CODIGO_ACTIVO'] = '';
                }
                $this->state['TIPO_ITEM'] = 1;
        
                $dupli =Equipo::where('NRO_SERIE', $this->state['NRO_SERIE'])
                    ->first();

                if ($dupli) {
                    $this->dispatchBrowserEvent( 'alert', ['type' => 'error',  'message' => 'El número de serie ya se encuentra regstrado.']);
                }else{
                    $save = Equipo::create($this->state);
                    if ($save) {
                        $save2 = EquipoInventario::create(['equipo_id' => $save->Id, 'origen_id' => 0,'persona_id' => $this->persona_id, 'tipo' => 3,'motivo' => 0,'estado' => 1,'anio' => date('Y'), 'fecha' =>date('Y-m-d H:i:s'),'IdUsuarioCrea' => auth()->user()->id]);
                    }
                    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Equipo Guardado Correctamente']);redirect()->route('qr/equipo', ['id' => $save->Id]);
                    $this->dispatchBrowserEvent('hide-form3');
                }
                DB::commit();
                
            
            } catch (\Throwable $th) {
                DB::rollback();
                dd($th);
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Ocurrio un error inesperado']);
            } 
            
        }
    }
    public function render(){
        return view('livewire.patrimonio.qr.buscar-number');
    }
}