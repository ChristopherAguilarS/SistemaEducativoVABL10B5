<?php

namespace App\Livewire\Rrhh\Trabajadores\Components;

use App\Models\Academico\Carrera;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\VinculoLaboral;
use App\Models\RecursosHumanos\CatalogoArea;
use App\Models\RecursosHumanos\CatalogoCargo;
use App\Models\RecursosHumanos\CatalogoRegimen;
use App\Models\RecursosHumanos\CatalogoCondicion;
use App\Models\RecursosHumanos\Persona;
use DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Karriere\PdfMerge\PdfMerge;
class VerIngreso extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = [], $editar = false, $idDel, $idSel, $areas, $cargos, $documento, $nombres, $regimen, $regimenes, $condiciones, $idPers, $existe, $archivo;
    #[On('nuevo')]
    public function onNuevo($id = 0){
        if($id){
            $this->titulo = "Editar Nivel Academico";
            $this->state = Carrera::find($id)->toarray();
            $this->editar = $id;
        }else{
            $this->titulo = "Ingreso de Personal";
            $this->regimen = 0;
            $this->idSel = 0;
            $this->documento = '';
            $this->nombres = '';
            $this->state = ['catalogo_tipo_trabajador_id' => 1, 'catalogo_tipo_documento' =>0, 'catalogo_condiciones_id' =>0, 'fecha_inicio' =>null, 'fecha_fin' =>null, 'catalogo_area_id' =>0, 'catalogo_cargo_id' =>0];
            $this->editar = false;
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
    public function updatedregimen($id){
        $this->condiciones = CatalogoCondicion::where('estado', 1)->where('catalogo_regimen_id', $id)->get();
    }
    public function buscar(){
        $this->idPers = 0;
        $data = Persona::leftjoin('rrhh_vinculo_laboral as vl', 'vl.persona_id', 'rrhh_personas.id')
            ->select('rrhh_personas.id', 'rrhh_personas.apellidoPaterno', 'rrhh_personas.apellidoMaterno', 'rrhh_personas.nombres', 'vl.estado')
            ->where('numeroDocumento', $this->documento)->first();
        if($data){
            if($data->estado == 1){
                $this->dispatch('alert_danger', ['mensaje' => 'Trabaja ya tiene un contrato vigente']);
            }else{
                $this->nombres = $data->apellidoPaterno.' '.$data->apellidoMaterno.', '.$data->nombres;
                $this->idPers = $data->id;
                $archivo = 'legajos/'.$this->idPers.'/contratos.pdf';
                $rutaCompleta = public_path($archivo);
                if (file_exists($rutaCompleta)) {
                    $this->existe = true;
                } else {
                    $this->existe = false;
                }
                $this->dispatch('alert_info', ['mensaje' => 'Trabajador Encontrado']);
            }
        }else{
            $this->nombres = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Trabajador no Encontrado']);
        }
    }
    public function guardar(){
        $this->validate([ 
            'documento' => 'required|not_in:0',
            'nombres' => 'required',
            'state.catalogo_tipo_trabajador_id' => 'required|not_in:0',
            'state.catalogo_tipo_documento' => 'required|not_in:0',
            'regimen' => 'required|not_in:0',
            'state.catalogo_condiciones_id' => 'required|not_in:0',
            'state.fecha_inicio' => 'required',
            'state.fecha_fin' => 'required',
            'state.catalogo_area_id' => 'required|not_in:0',
            'state.catalogo_cargo_id' => 'required|not_in:0'
        ]);
        try {
            if($this->editar){
                $nivel = VinculoLaboral::find($this->editar);
                    $nivel->catalogo_tipo_trabajador_id = $this->state['catalogo_tipo_trabajador_id'];
                    $nivel->catalogo_tipo_documento = $this->state['catalogo_tipo_documento'];
                    $nivel->catalogo_condiciones_id = $this->state['catalogo_condiciones_id'];
                    $nivel->fecha_inicio = $this->state['fecha_inicio'];
                    $nivel->fecha_fin = $this->state['fecha_fin'];
                    $nivel->catalogo_area_id = $this->state['catalogo_area_id'];
                    $nivel->catalogo_cargo_id = $this->state['catalogo_cargo_id'];
                    $nivel->estado = $this->state['estado'];
                $nivel->save();
            }else{
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d');
                $this->state['persona_id'] = $this->idPers;
                $this->state['estado'] = 1;
                $p = Persona::find($this->idPers);
                    $p->estado=1;
                $p->save();
                $nivel = VinculoLaboral::create($this->state);
            }
            if ($this->archivo) {
                if($this->existe && !$this->reemplaza){
                    $rutaTemporalA = $this->archivo->store('temp', 'public');
                    $pdfMerge = new PdfMerge();
                    $pdfMerge->add(Storage::disk('public')->path($rutaTemporalA));
                    $pdfPathB = public_path('legajos/'.$this->idPers.'/contratos.pdf');
                    $pdfMerge->add($pdfPathB);
                    $pdfMerge->merge(public_path('legajos/'.$this->idPers.'/contratos.pdf'));
                    Storage::disk('public')->delete($rutaTemporalA);
                }else{
                    $file = $this->archivo->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = 'contratos.'.$extension;
                    $this->archivo->storeAs('legajos/'.$this->idPers.'/',$nombre, 'public');
                }
            }
            $this->dispatch('alert_info', ['mensaje' => 'Guardado Correctamente']);
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        $this->areas = CatalogoArea::where('estado', 1)->get();
        $this->cargos = CatalogoCargo::where('estado', 1)->get();
        $this->regimenes = CatalogoRegimen::where('estado', 1)->get();
        $especificas = VinculoLaboral::join('rrhh_personas as p', 'rrhh_vinculo_laboral.persona_id', 'p.id')
            ->leftjoin('rrhh_catalogo_condiciones as cc', 'cc.id', 'rrhh_vinculo_laboral.catalogo_condiciones_id')
            ->leftjoin('rrhh_catalogo_areas as ca', 'ca.id', 'rrhh_vinculo_laboral.catalogo_area_id')
            ->select(DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) as nombres"), 'numeroDocumento AS dni', 'p.id', 'rrhh_vinculo_laboral.fecha_inicio', 'ca.descripcion as area', 'catalogo_tipo_trabajador_id')
            ->where('p.id', $this->idSel)
            ->get();
        return view('livewire.rrhh.trabajadores.components.ver-ingreso', ['especificas'=>$especificas]);
    }
}
