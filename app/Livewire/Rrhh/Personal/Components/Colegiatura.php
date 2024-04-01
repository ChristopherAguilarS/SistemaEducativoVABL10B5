<?php

namespace App\Livewire\Rrhh\Personal\Components;

use App\Models\RecursosHumanos\Persona;
use App\Models\RecursosHumanos\LegColegio;
use App\Models\RecursosHumanos\CatalogoColegio;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Karriere\PdfMerge\PdfMerge;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use DB;
class Colegiatura extends Component {
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $estudios, $idDel,$archivo, $numeroDocumento, $idSel, $nombres, $state = ['catalogo_colegio_id'=>  0, 'fecha'=>null,'numero'=> ''];
    public $existe = false, $reemplaza = false, $colegios;
    #[On('colegiatura')]
    public function colegiatura($id = 0){
        $this->idSel = 0;
        $this->reemplaza = false;
        $this->archivo = null;
        $this->titulo = "Colegiatura";
        $this->numeroDocumento = '';
        $this->nombres = '';
        $this->limpiar();
        $this->estudios = null;
        $this->dispatch('verModal', ['id' => 'form4', 'accion' => 'show']);
    }
    public function limpiar(){
        $this->state = ['catalogo_colegio_id'=>  0, 'fecha'=>null,'numero'=> ''];
    }
    public function eliminar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el estudio #'.($id + 1), 'funcion' => 'brColegia']);
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
        $data = LegColegio::join('rrhh_catalogo_colegios AS cc', 'rrhh_leg_colegiaturas.catalogo_colegio_id', 'cc.id')
            ->select('cc.descripcion as colegio', 'rrhh_leg_colegiaturas.fecha', 'rrhh_leg_colegiaturas.numero', DB::raw("'1' as estado"))
            ->where('persona_id', $this->idSel)->get();
        if($data){
            $this->estudios = $data->toarray();
        }else{
            $this->estudios = null;
        }
        $archivo = 'legajos/'.$this->idSel.'/colegiatura.pdf';
        $rutaCompleta = public_path($archivo);
        if (file_exists($rutaCompleta)) {
            $this->existe = true;
        } else {
            $this->existe = false;
        }
    }
    #[On('brColegia')]
    public function brColegia(){
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
                'state.catalogo_colegio_id' => 'required|not_in:0',
                'state.fecha' => 'required',
                'state.numero' => 'required',
            ]);
            $this->state['estado'] = 1;
            $dd = $this->colegios->where('id', $this->state['catalogo_colegio_id'])->first();
            $this->state['colegio'] = $dd->descripcion;
            $this->estudios[] =  $this->state;
            $this->limpiar();
            $this->dispatch('alert_info', ['mensaje' => 'Añadido Correctamente']);
        }else{
            $this->dispatch('alert_danger', ['mensaje' => 'Debes de seleccionar una persona']);
        }
    }
    public function guardar(){
        try {
            $del = LegColegio::where('persona_id', $this->idSel)->delete();
            if($this->estudios){
                foreach ($this->estudios as $data) {
                    if($data['estado']){
                        $data['persona_id'] = $this->idSel;
                        $data['created_by'] = auth()->user()->id;
                        $data['created_at'] = date('Y-m-d');
                        LegColegio::create($data);
                    }
                }
            }
            if ($this->archivo) {
                if($this->existe && !$this->reemplaza){
                    $rutaTemporalA = $this->archivo->store('temp', 'public');
                    $pdfMerge = new PdfMerge();
                    $pdfMerge->add(Storage::disk('public')->path($rutaTemporalA));
                    $pdfPathB = public_path('legajos/'.$this->idSel.'/colegiatura.pdf');
                    $pdfMerge->add($pdfPathB);
                    $pdfMerge->merge(public_path('legajos/'.$this->idSel.'/colegiatura.pdf'));
                    Storage::disk('public')->delete($rutaTemporalA);
                }else{
                    $file = $this->archivo->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = 'colegiatura.'.$extension;
                    $this->archivo->storeAs('legajos/'.$this->idSel.'/',$nombre, 'public');
                }
            }
            $this->dispatch('alert_info', ['mensaje' => 'Guardado Correctamente']);
          //  $this->dispatch('verModal', ['id' => 'form4', 'accion' => 'hide']);
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        $this->colegios = CatalogoColegio::get();
        return view('livewire.rrhh.personal.components.colegiatura');
    }
}
