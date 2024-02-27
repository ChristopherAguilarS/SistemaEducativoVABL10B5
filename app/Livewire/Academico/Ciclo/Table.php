<?php

namespace App\Livewire\Academico\Ciclo;

use App\Livewire\Forms\CrearCicloForm;
use App\Models\AñoAcademico;
use App\Models\Ciclo;
use App\Models\TipoCiclo;
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
    public $cicloId;
    public $cicloT;
    public $titulo;
    public $tipo_ciclos;
    public $año_academicos;
    public $ciclo_id;
    public $año_academico_id;
    public CrearCicloForm $form;

    public function mount(){
        $this->tipo_ciclos = TipoCiclo::where('estado',1)->orderBy('descripcion')->get();
        $this->año_academicos =AñoAcademico::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('agregar')]
    public function agregar(){
        $this->cicloId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva Ciclo';
        $this->dispatch('anularSeleccion');
        $this->dispatch('anularSeleccionAño');
    }

    public function editar($id){
        $Ciclo = Ciclo::find($id);
        $this->titulo = 'Editar Ciclo - '.optional($Ciclo)->descripcion;
        $this->cicloId = $id;
        $this->form->descripcion = $Ciclo->descripcion;
        $this->form->tipo_ciclo_id = $Ciclo->tipo_ciclo_id;
        $this->dispatch('cambiarSeleccion', id: $Ciclo->tipo_ciclo_id);
        $this->dispatch('cambiarSeleccionAño', id: $Ciclo->año_academico_id);
    }

    public function cambiarEstado($id){
        $Ciclo = Ciclo::find($id);
        $Ciclo->estado = !$Ciclo->estado;
        $Ciclo->save();
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
        if($this->cicloId == null){
            $this->mensaje = "Ciclo registrado exitosamente";
        }
        else{
            $this->mensaje = "Ciclo actualizado exitosamente";
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
                text: "No se pudo registrar el Ciclo",
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
            $tipo = Ciclo::updateOrCreate(
                [
                    'id'=>$this->cicloId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'tipo_ciclo_id' => $this->form->tipo_ciclo_id,
                    'año_academico_id' => $this->form->año_academico_id,
                    'fecha_inicio' => $this->form->fecha_inicio,
                    'fecha_fin' => $this->form->fecha_fin,
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
        $ciclos = Ciclo::paginate(10);
        return view('livewire.academico.ciclo.table',['ciclos'=>$ciclos]);
    }
}
