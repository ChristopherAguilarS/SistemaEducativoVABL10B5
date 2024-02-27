<?php

namespace App\Livewire\Academico\ConceptoIngreso;

use App\Livewire\Forms\CrearConceptoIngresoForm;
use App\Models\AñoAcademico;
use App\Models\Ciclo;
use App\Models\ConceptoIngreso;
use App\Models\EspecificaNivel2;
use App\Models\TipoConceptoIngreso;
use App\Models\TipoIngreso;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $mensaje;
    public $conceptoingresoId;
    public $conceptoingresoT;
    public $titulo;
    public $tipo_ingresos;
    public $especificas2;
    public $ciclos;
    public $conceptoingreso_id;
    public $año_academico_id;
    public CrearConceptoIngresoForm $form;

    public function mount(){
        $this->tipo_ingresos = TipoIngreso::where('estado',1)->orderBy('descripcion')->get();
        $this->especificas2 = EspecificaNivel2::where('estado',1)->orderBy('descripcion')->get();
        $this->ciclos = Ciclo::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->conceptoingresoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva ConceptoIngreso';
        $this->dispatch('anularSeleccion');
        $this->dispatch('anularSeleccionAño');
    }

    public function editar($id){
        $ConceptoIngreso = ConceptoIngreso::find($id);
        $this->titulo = 'Editar ConceptoIngreso - '.optional($ConceptoIngreso)->descripcion;
        $this->conceptoingresoId = $id;
        $this->form->descripcion = $ConceptoIngreso->descripcion;
        $this->form->fecha_vigencia = $ConceptoIngreso->fecha_vigencia;
        $this->form->ciclo_id = $ConceptoIngreso->ciclo_id;
        $this->form->especifica_nivel_2_id = $ConceptoIngreso->especifica_nivel_2_id;
        $this->form->tipo_ingreso_id = $ConceptoIngreso->tipo_ingreso_id;
        $this->form->tipo = $ConceptoIngreso->tipo;
        $this->form->monto = $ConceptoIngreso->monto;        
        $this->dispatch('cambiarSeleccion', id: $ConceptoIngreso->tipo_conceptoingreso_id);
        $this->dispatch('cambiarSeleccionAño', id: $ConceptoIngreso->año_academico_id);
    }

    public function cambiarEstado($id){
        $ConceptoIngreso = ConceptoIngreso::find($id);
        $ConceptoIngreso->estado = !$ConceptoIngreso->estado;
        $ConceptoIngreso->save();
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
        if($this->conceptoingresoId == null){
            $this->mensaje = "ConceptoIngreso registrado exitosamente";
        }
        else{
            $this->mensaje = "ConceptoIngreso actualizado exitosamente";
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
                text: "No se pudo registrar el ConceptoIngreso",
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
            $tipo = ConceptoIngreso::updateOrCreate(
                [
                    'id'=>$this->conceptoingresoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'especifica_nivel_2_id' => $this->form->especifica_nivel_2_id,
                    'ciclo_id' => $this->form->ciclo_id,
                    'fecha_vigencia' => $this->form->fecha_vigencia,
                    'tipo_ingreso_id' => $this->form->tipo_ingreso_id,
                    'monto'=>$this->monto,
                    'tipo'=>$this->tipo,
                    'estado' => 1,
                    'condicion' =>1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            dd($e);
           $this->mensajedeError();
        }
        
    }

    public function render()
    {
        $conceptoIngresos = ConceptoIngreso::paginate(10);
        return view('livewire.academico.concepto_ingreso.table',['conceptoIngresos'=>$conceptoIngresos]);
    }
}
