<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion\ObjetivosEstrategicos;

use App\Livewire\Forms\CrearObjetivoEstrategicoForm;
use App\Models\ActividadOperativa;
use App\Models\AñoAcademico;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanAnualTrabajo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearObjetivoEstrategicoForm $form;
    public $titulo = 'Crear Nuevo Objetivo Estrategico';
    public $objetivoEstrategicoT;
    public $objetivoEstrategicoId;
    public $objetivoSeleccionado;
    public $mensaje;
    public $añoSeleccionado;
    public $planSeleccionado;
    

    public $filaSeleccionada;

    #[On('agregar')]
    public function agregar(){
        $this->objetivoEstrategicoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Objetivo Estrategico';
    }

    public function editar($id){
        $objetivoEstrategico = ObjetivoEstrategico::find($id);
        $this->titulo = 'Editar Objetivo Estrategico -'.optional($this->objetivoEstrategicoT)->descripcion;
        $this->objetivoEstrategicoId = $id;
        $this->form->codigo = $objetivoEstrategico->codigo;
        $this->form->descripcion = $objetivoEstrategico->descripcion;
        $this->form->monto_asignado = $objetivoEstrategico->monto_asignado;
    }

    public function tooltip($id){
        $this->objetivoSeleccionado = ObjetivoEstrategico::find($id);
        $this->titulo = 'Detalle de Objetivo Estrategico';
    }

    public function cambiarEstado($id){
        $objetivoEstrategico = ObjetivoEstrategico::find($id);
        $objetivoEstrategico->estado = !$objetivoEstrategico->estado;
        $objetivoEstrategico->save();
        $this->mensajedeExitoCambioEstado();
    }

    public function limpiarCampos(){
        $this->form->limpiarCampos();
    }

    #[Js] 
    public function cerrarModal()
    {
       
        $this->js(<<<'JS'
            $('#myModal').modal('hide')
        JS);
    }

    #[Js] 
    public function mensajedeExitoCambioEstado()
    {
        $this->js(<<<'JS'
            Toastify({
                avatar: "",
                text: "Cambio de estado exitosamente",
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeExito()
    {
        if($this->objetivoEstrategicoId == null){
            $this->mensaje = "Objetivo Estrategico registrado exitosamente";
        }
        else{
            $this->mensaje = "Objetivo Estrategico actualizado exitosamente";
        }
        $this->js(<<<'JS'
            Toastify({
                text: $wire.mensaje,
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeError()
    {
        $this->js(<<<'JS'
            Toastify({
                text: "No se pudo registrar el objetivo estrategico",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function guardar(){
        $this->form->validate();
        try {
            $tipo = ObjetivoEstrategico::updateOrCreate(
                [
                    'id'=>$this->objetivoEstrategicoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'monto_asignado' => $this->form->monto_asignado,
                    'monto_ejecutado' => 0,
                    'saldo' => 0,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            $this->mensajedeError();
        }
        
    }

    public function limpiarSeleccion(){
        $this->filaSeleccionada = null;
        $this->dispatch('enviarObjetivoEstrategico',$this->filaSeleccionada);
    }

    public function seleccionarFila($filaId)
    {
        $this->filaSeleccionada = $filaId;
        $this->dispatch('enviarObjetivoEstrategico',$this->filaSeleccionada);
    }

    public function mount(){
        $fecha = Carbon::now();
        $año = $fecha->year-1;
        $añoAcademicoSeleccionado = AñoAcademico::where('año',$año)->first();  
        $this->añoSeleccionado = optional($añoAcademicoSeleccionado)->id;
        $this->planSeleccionado = PlanAnualTrabajo::where('año_academico_id',$this->añoSeleccionado)->first();
    }

    
    public function render()
    {
        $objetivoEstrategicos = ObjetivoEstrategico::where('plan_anual_trabajo_id',2)->paginate(10);
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.objetivos-estrategicos.table',['objetivoEstrategicos'=>$objetivoEstrategicos]);
    }
}
