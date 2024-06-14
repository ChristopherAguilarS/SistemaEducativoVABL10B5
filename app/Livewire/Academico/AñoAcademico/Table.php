<?php

namespace App\Livewire\Academico\AñoAcademico;

use App\Livewire\Forms\CrearAñoAcademicoForm;
use App\Models\AñoAcademico;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public CrearAñoAcademicoForm $form;
    public $titulo = 'Crear Nuevo Año Academico';
    public $añoAcademicoT;
    public $añoAcademicoId;
    public $mensaje;
    public $años = ['2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033'];

    #[On('agregar')]
    public function agregar(){
        $this->añoAcademicoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo Año Academico';
    }

    public function editar($id){
        $añoAcademico = AñoAcademico::find($id);
        $this->titulo = 'Editar Año Academico -'.optional($this->añoAcademicoT)->descripcion;
        $this->añoAcademicoId = $id;
        $this->form->descripcion = $añoAcademico->descripcion;
    }

    public function cambiarEstado($id){
        $añoAcademico = AñoAcademico::find($id);
        $añoAcademico->estado = !$añoAcademico->estado;
        $añoAcademico->save();
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
        if($this->añoAcademicoId == null){
            $this->mensaje = "Año Academico registrado exitosamente";
        }
        else{
            $this->mensaje = "Año Academico actualizado exitosamente";
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
                text: "No se pudo registrar el año academico",
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
            $tipo = AñoAcademico::updateOrCreate(
                [
                    'id'=>$this->añoAcademicoId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'año' => $this->form->año,
                    'fecha_inicio' => $this->form->fecha_inicio,
                    'fecha_fin' => $this->form->fecha_fin,
                    'estado' => 1,
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
        $añoAcademicos = AñoAcademico::paginate(10);
        return view('livewire.academico.año-academico.table',['añoAcademicos'=>$añoAcademicos]);
    }
}
