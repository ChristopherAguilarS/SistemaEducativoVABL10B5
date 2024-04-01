<?php

namespace App\Livewire\Rrhh\Trabajadores\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\VinculoLaboral;
use App\Models\RecursosHumanos\VinculoDetalle;
use App\Models\RecursosHumanos\Merito;
use App\Models\RecursosHumanos\Demerito;
use DB;
class Resumen extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = [], $editar = false, $idDel, $idSel, $areas, $cargos, $documento, $nombres, $regimen, $regimenes, $condiciones;
    public $tab = 1, $idPers;
    #[On('verResumen')]
    public function verResumen($id = 0){
        $this->idPers = $id;
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function act($id){
        $this->tab = $id;
    }
    public function render(){
        if($this->tab == 1){
            $data = VinculoLaboral::leftjoin('rrhh_catalogo_condiciones as c', 'c.id', 'rrhh_vinculo_laboral.catalogo_condiciones_id')
                ->leftjoin('rrhh_catalogo_areas as a', 'a.id', 'rrhh_vinculo_laboral.catalogo_area_id', 'rrhh_vinculo_laboral.estado')
                ->select('fecha_inicio', 'fecha_fin', 'c.descripcion as condicion', 'a.descripcion as area', 'catalogo_tipo_trabajador_id', 'rrhh_vinculo_laboral.estado')
                ->where('persona_id', $this->idPers)->get();
        }elseif($this->tab == 2){
            $data = VinculoDetalle::join('rrhh_vinculo_laboral as vl', 'vl.id', 'rrhh_vinculo_detalle.vinculo_laboral_id')
                ->select('rrhh_vinculo_detalle.fecha_inicio', 'rrhh_vinculo_detalle.fecha_fin', 'rrhh_vinculo_detalle.created_at')
                ->where('vl.persona_id', $this->idPers)->get();
        }elseif($this->tab == 3){
            $data = Merito::join('rrhh_catalogo_motivos as cm', 'rrhh_meritos.catalogo_motivo_id', 'cm.id')
                ->select('rrhh_meritos.fecha_emision', 'rrhh_meritos.observaciones', 'cm.descripcion as motivo')
                ->where('rrhh_meritos.persona_id', $this->idPers)->get();
        }elseif($this->tab == 4){
            $data = Demerito::join('rrhh_catalogo_motivos as cm', 'rrhh_demeritos.catalogo_motivo_id', 'cm.id')
                ->select('rrhh_demeritos.fecha_emision', 'rrhh_demeritos.observaciones', 'cm.descripcion as motivo')
                ->where('rrhh_demeritos.persona_id', $this->idPers)->get();
        }
        return view('livewire.rrhh.trabajadores.components.resumen', ['data' => $data]);
    }
}
