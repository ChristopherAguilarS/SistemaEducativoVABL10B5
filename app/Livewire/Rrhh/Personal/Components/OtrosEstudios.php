<?php

namespace App\Livewire\Rrhh\Personal\Components;

use App\Models\RecursosHumanos\Persona;
use App\Models\RecursosHumanos\LegOtrosEstudios;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Karriere\PdfMerge\PdfMerge;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use DB;
class OtrosEstudios extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $estudios, $idDel,$archivo, $numeroDocumento, $idSel, $nombres, $state = ['institucion_nombre'=>  '', 'estudio_nombre'=>'','codigo'=> '','horas'=> '','creditos'=> '','fecha_inicio'=> null,'fecha_fin'=> null], $editar = false;
    public $existe = false, $reemplaza = false;
    #[On('otrosEstudios')]
    public function otrosEstudios($id = 0){
        $this->idSel = 0;
        $this->reemplaza = false;
        $this->archivo = null;
        $this->titulo = "Otros Estudios(Capacitaciones y Diplomados)";
        $this->numeroDocumento = '';
        $this->nombres = '';
        $this->limpiar();
        $this->estudios = null;
        $this->dispatch('verModal', ['id' => 'form6', 'accion' => 'show']);
    }
    public function limpiar(){
        $this->state = ['institucion_nombre'=>  '', 'estudio_nombre'=>'','codigo'=> '','horas'=> '','creditos'=> '','fecha_inicio'=> null,'fecha_fin'=> null];
    }
    public function eliminar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el estudio #'.($id + 1), 'funcion' => 'brOtroEst']);
    }
    public function cancelar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se cancelara la eliminacion del estudio #'.($id + 1), 'funcion' => 'brCancel']);
    }
    public function buscar(){
        $this->reemplaza = false;
        $this->archivo = null;
        $data = Persona::where('numeroDocumento', $this->numeroDocumento)->first();
        if($data){
            $this->idSel = $data->id;
            $this->nombres = $data->apellidoPaterno.' '.$data->apellidoMaterno.', '.$data->nombres;
            $this->dispatch('alert_info', ['mensaje' => 'Encontrado Correctamente']);
        }else{
            $this->idSel = 0;
            $this->nombres = '';
            $this->dispatch('alert_danger', ['mensaje' => 'Persona no encontrada']);
        }
        $data = LegOtrosEstudios::select('institucion_nombre', 'estudio_nombre', 'codigo', 'horas', 'creditos', 'fecha_inicio', 'fecha_fin', DB::raw("'1' as estado"))->where('persona_id', $this->idSel)->get();
        if($data){
            $this->estudios = $data->toarray();
        }else{
            $this->estudios = null;
        }
        $archivo = 'legajos/'.$this->idSel.'/otros-estudios.pdf';
        $rutaCompleta = public_path($archivo);
        if (file_exists($rutaCompleta)) {
            $this->existe = true;
        } else {
            $this->existe = false;
        }
    }
    #[On('brOtroEst')]
    public function brOtroEst(){
        $this->estudios[$this->idDel]['estado'] = 0;
        $this->dispatch('alert_info', ['mensaje' => 'Retirado Correctamente']);
    }
    #[On('brCancel')]
    public function brCancel(){
        $this->estudios[$this->idDel]['estado'] = 1;
        $this->dispatch('alert_info', ['mensaje' => 'Agregado Correctamente']);
    }
    
    public function aniadir(){
        if($this->idSel){
            $this->validate([
                'state.institucion_nombre' => 'required',
                'state.estudio_nombre' => 'required',
                'state.fecha_inicio' => 'required',
                'state.fecha_fin' => 'required'
            ]);
            $this->state['estado'] = 1;
            $this->estudios[] =  $this->state;
            $this->limpiar();
            $this->dispatch('alert_info', ['mensaje' => 'Añadido Correctamente']);
        }else{
            $this->dispatch('alert_danger', ['mensaje' => 'Debes de seleccionar una persona']);
        }
    }
    public function guardar(){
        try {
            $del = LegOtrosEstudios::where('persona_id', $this->idSel)->delete();
            if($this->estudios){
                foreach ($this->estudios as $data) {
                    if($data['estado']){
                        $data['persona_id'] = $this->idSel;
                        $data['created_by'] = auth()->user()->id;
                        $data['created_at'] = date('Y-m-d');
                        LegOtrosEstudios::create($data);
                    }
                }
            }
            if ($this->archivo) {
                if($this->existe && !$this->reemplaza){
                    $rutaTemporalA = $this->archivo->store('temp', 'public');
                    $pdfMerge = new PdfMerge();
                    $pdfMerge->add(Storage::disk('public')->path($rutaTemporalA));
                    $pdfPathB = public_path('legajos/'.$this->idSel.'/otros-estudios.pdf');
                    $pdfMerge->add($pdfPathB);
                    $pdfMerge->merge(public_path('legajos/'.$this->idSel.'/otros-estudios.pdf'));
                    Storage::disk('public')->delete($rutaTemporalA);
                }else{
                    $file = $this->archivo->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = 'otros-estudios.'.$extension;
                    $this->archivo->storeAs('legajos/'.$this->idSel.'/',$nombre, 'public');
                }
            }
            $this->dispatch('alert_info', ['mensaje' => 'Guardado Correctamente']);
          //  $this->dispatch('verModal', ['id' => 'form6', 'accion' => 'hide']);
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        return view('livewire.rrhh.personal.components.otros-estudios');
    }
}