<?php

namespace App\Livewire\Rrhh\Trabajadores\Components;

use App\Models\Academico\Carrera;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\RecursosHumanos\Persona;
use App\Models\RecursosHumanos\CatalogoMotivo;
use App\Models\RecursosHumanos\Demerito;
use DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Karriere\PdfMerge\PdfMerge;
class VerDemerito extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = [], $editar = false, $idDel, $idSel, $nombres, $idPers, $documento, $motivos, $existe, $archivo;
    #[On('nuevoDemerito')]
    public function nuevoDemerito($id = 0){
        if($id){
            $this->titulo = "Editar Nivel Academico";
            $this->state = Carrera::find($id)->toarray();
            $this->editar = $id;
        }else{
            $this->titulo = "Ingreso de Demeritos del Trabajador";
            $this->regimen = 0;
            $this->idSel = 0;
            $this->documento = '';
            $this->nombres = '';
            $this->state = ['catalogo_motivo_id' => 0, 'fecha_emision' =>date('Y-m-d'), 'observaciones' =>''];
            $this->editar = false;
        }
        $this->dispatch('verModal', ['id' => 'form5', 'accion' => 'show']);
    }
    public function buscar(){
        $this->idPers = 0;
        $data = Persona::leftjoin('rrhh_vinculo_laboral as vl', 'vl.persona_id', 'rrhh_personas.id')
            ->select('rrhh_personas.id', 'rrhh_personas.apellidoPaterno', 'rrhh_personas.apellidoMaterno', 'rrhh_personas.nombres', 'vl.estado')
            ->where('numeroDocumento', $this->documento)->first();
        if($data){
            if($data->estado == 1){
                $this->nombres = $data->apellidoPaterno.' '.$data->apellidoMaterno.', '.$data->nombres;
                $this->idPers = $data->id;
                $archivo = 'legajos/'.$this->idPers.'/demeritos.pdf';
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
            'state.catalogo_motivo_id' => 'required|not_in:0',
            'state.fecha_emision' => 'required',
            'state.observaciones' => 'required',
            'documento' => 'required|not_in:0',
            'nombres' => 'required'
        ]);
        try {
            if($this->editar){
                $nivel = Demerito::find($this->editar);
                    $nivel->tipo_documento_id = $this->state['tipo_documento_id'];
                    $nivel->fecha_inicio = $this->state['fecha_inicio'];
                    $nivel->fecha_fin = $this->state['fecha_fin'];
                $nivel->save();
            }else{
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d');
                $this->state['persona_id'] = $this->idPers;
                $this->state['vinculo_laboral_id'] = $this->idPers;
                $nivel = Demerito::create($this->state);
            }
            if ($this->archivo) {
                if($this->existe && !$this->reemplaza){
                    $rutaTemporalA = $this->archivo->store('temp', 'public');
                    $pdfMerge = new PdfMerge();
                    $pdfMerge->add(Storage::disk('public')->path($rutaTemporalA));
                    $pdfPathB = public_path('legajos/'.$this->idPers.'/demeritos.pdf');
                    $pdfMerge->add($pdfPathB);
                    $pdfMerge->merge(public_path('legajos/'.$this->idPers.'/demeritos.pdf'));
                    Storage::disk('public')->delete($rutaTemporalA);
                }else{
                    $file = $this->archivo->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = 'demeritos.'.$extension;
                    $this->archivo->storeAs('legajos/'.$this->idPers.'/',$nombre, 'public');
                }
            }
            $this->dispatch('alert_info', ['mensaje' => 'Guardado Correctamente']);
            $this->dispatch('verModal', ['id' => 'form5', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        $this->motivos = CatalogoMotivo::where('estado', 1)->where('tipo', 2)->get();
        return view('livewire.rrhh.trabajadores.components.ver-demerito');
    }
}
