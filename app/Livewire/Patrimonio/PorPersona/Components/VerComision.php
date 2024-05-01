<?php

namespace App\Livewire\Patrimonio\PorPersona\Components;

use App\Models\Academico\Carrera;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\VinculoDetalle;
use App\Models\RecursosHumanos\Persona;
use DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Karriere\PdfMerge\PdfMerge;
class VerComision extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = [], $editar = false, $idDel, $idSel, $nombres, $idVinculo, $idPers, $documento, $existe, $archivo;
    #[On('nuevoAdenda')]
    public function nuevoAdenda($id = 0){
        if($id){
            $this->titulo = "Editar Nivel Academico";
            $this->state = Carrera::find($id)->toarray();
            $this->editar = $id;
        }else{
            $this->titulo = "Ingreso de Adenda";
            $this->regimen = 0;
            $this->idSel = 0;
            $this->documento = '';
            $this->nombres = '';
            $this->state = ['catalogo_tipo_trabajador_id' => 1, 'catalogo_tipo_documento' =>0, 'catalogo_condiciones_id' =>0, 'fecha_inicio' =>null, 'fecha_fin' =>null, 'catalogo_area_id' =>0, 'catalogo_cargo_id' =>0];
            $this->editar = false;
        }
        $this->dispatch('verModal', ['id' => 'form3', 'accion' => 'show']);
    }
    public function buscar(){
        $this->idVinculo = 0;
        $data = Persona::leftjoin('rrhh_vinculo_laboral as vl', 'vl.persona_id', 'rrhh_personas.id')
            ->select('vl.id', 'rrhh_personas.apellidoPaterno', 'rrhh_personas.apellidoMaterno', 'rrhh_personas.nombres', 'vl.estado')
            ->where('numeroDocumento', $this->documento)->first();
        if($data){
            if($data->estado == 1){
                $this->nombres = $data->apellidoPaterno.' '.$data->apellidoMaterno.', '.$data->nombres;
                $this->idVinculo = $data->id;
                $archivo = 'legajos/'.$this->idPers.'/contratos.pdf';
                $rutaCompleta = public_path($archivo);
                if (file_exists($rutaCompleta)) {
                    $this->existe = true;
                } else {
                    $this->existe = false;
                }
                $this->dispatch('alert_info', ['mensaje' => 'Trabajador Encontrado']);
            }else{
                $this->dispatch('alert_danger', ['mensaje' => 'Trabaja no tiene un contrato vigente']);
            }
        }else{
            $this->nombres = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Trabajador no Encontrado']);
        }
    }
    public function guardar(){
        $this->validate([ 
            'state.tipo_documento_id' => 'required|not_in:0',
            'state.fecha_inicio' => 'required',
            'state.fecha_fin' => 'required',
            'documento' => 'required|not_in:0',
            'nombres' => 'required'
        ]);
        try {
            if($this->editar){
                $nivel = VinculoDetalle::find($this->editar);
                    $nivel->tipo_documento_id = $this->state['tipo_documento_id'];
                    $nivel->fecha_inicio = $this->state['fecha_inicio'];
                    $nivel->fecha_fin = $this->state['fecha_fin'];
                $nivel->save();
            }else{
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d');
                $this->state['persona_id'] = $this->idPers;
                $this->state['estado'] = 1;
                $this->state['vinculo_laboral_id'] = $this->idVinculo;
                $nivel = VinculoDetalle::create($this->state);
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
            $this->dispatch('verModal', ['id' => 'form3', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        return view('livewire.patrimonio.por-persona.components.ver-comision');
    }
}
