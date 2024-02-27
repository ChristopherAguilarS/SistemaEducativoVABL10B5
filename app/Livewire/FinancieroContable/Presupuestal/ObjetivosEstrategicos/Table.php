<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ObjetivosEstrategicos;

use App\Livewire\Forms\CrearObjetivoEstrategicoForm;
use App\Models\ObjetivoEstrategico;
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
    public $mensaje;

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

    public function render()
    {
        $objetivoEstrategicos = ObjetivoEstrategico::paginate(10);
        return view('livewire.financiero-contable.presupuestal.objetivos-estrategicos.table',['objetivoEstrategicos'=>$objetivoEstrategicos]);
    }
}
