<?php
namespace App\Livewire\Patrimonio\Prestamos\Components;

use App\Models\Patrimonio\Equipo;
use App\Models\Patrimonio\EquipoPrestado;
use App\Models\RecursosHumanos\VinculoLaboral;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use DB;
class Asignacion extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $urlFoto = '', $Foto, $preview, $equipo, $codigo, $descripcion, $idSel, $selTab = 0, $prestado, $search, $observaciones;

    #[On('Asignacion')]
    public function ver($equipo, $codigo, $descripcion){
        $pres = Equipo::find($equipo);
        if($pres->prestamo_persona_id){
            $this->prestado = 1;
            $this->titulo = 'Devolución de Equipo';
        }else{
            $this->prestado = 0;
            $this->titulo = 'Prestamo de Equipo';
        }
        $this->equipo = $codigo.' - '.$descripcion;
        $this->idSel = $equipo;
        $this->selTab = 0;
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function selecc($id){
        $this->selTab = $id;
    }
    public function guardar(){
        $sav = Equipo::where('id', $this->idSel)->update(['prestamo_persona_id' => $this->selTab]);
        $sav2 = EquipoPrestado:: create([
            'equipo_id' => $this->idSel,
            'persona_id' => $this->selTab,
            'observaciones_entrega' => $this->observaciones,
            'estado' => 1,
            'created_by' =>auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
        $this->dispatch('alert_info', ['mensaje' => 'Equipo Añadido Correctamente']);
    }
    public function devolver(){
        $sav = Equipo::where('id', $this->idSel)->update(['prestamo_persona_id' => 0]);
        $sav2 = EquipoPrestado::where('equipo_id', $this->idSel)->where('estado', 1)->update([
            'fecha_devolucion' => date('Y-m-d H:i:s'),
            'observaciones_devolucion' => $this->observaciones,
            'estado' => 0
        ]);
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
        $this->dispatch('alert_info', ['mensaje' => 'Equipo Retornado Correctamente']);
    }
    public function buscar(){
        $this->render();
    }
    public function render(){
        if(!$this->prestado){
            $data = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
                    ->leftjoin('rrhh_vinculo_detalle as vd', function ($join) {
                        $join->on('vd.vinculo_laboral_id', 'rrhh_vinculo_laboral.id')
                            ->where('vd.estado', DB::raw('1'));
                    })
                    ->join('rrhh_catalogo_cargos as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogo_cargo_id')
                    ->select('p.id', 'numeroDocumento', DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS noms"));
            if($this->search){
                $data = $data->whereRaw("numeroDocumento like '%".$this->search."%' or apellidoPaterno like '%".$this->search."%' or apellidoMaterno like '%".$this->search."%' or nombres like '%".$this->search."%'");
            }
            $data = $data->orderby('noms')->take(10)->get();
        }else{
            $data = [];
        }
        
        return view('livewire.patrimonio.prestamos.components.asignacion', ['posts' => $data]);
    }
}
