<?php

namespace App\Livewire\FinancieroContable\Contabilidad\NotasContables;

use App\Livewire\Forms\CrearNotaContableForm;
use App\Models\Cuenta;
use App\Models\NotaContable;
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
    public $notaId;
    public $notaT;
    public $titulo;
    public $cuentas;
    public $cuenta_id;
    public CrearNotaContableForm $form;

    public $fecha_inicio;
    public $fecha_fin;

    public function mount(){
        $this->cuentas = Cuenta::where('estado',1)->orderBy('descripcion')->get();
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('agregar')]
    public function agregar(){
        $this->notaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva nota';
    }

    public function editar($id){
        $nota = NotaContable::find($id);
        $this->titulo = 'Editar Nota - '.optional($nota)->descripcion;
        $this->notaId = $id;
        $this->form->codigo = $nota->codigo;
        $this->form->descripcion = $nota->descripcion;
        $this->form->cuenta_debe_id = $nota->cuenta_debe_id;
        $this->form->cuenta_haber_id = $nota->cuenta_haber_id;
        $this->form->fecha = $nota->fecha;
        $this->form->monto_debe = $nota->monto_debe;
        $this->form->monto_haber = $nota->monto_haber;
        $this->form->tipo = $nota->tipo;
        $this->dispatch('cambiarSeleccion', id: $nota->cuenta_id);
    }

    public function cambiarEstado($id){
        $nota = NotaContable::find($id);
        $nota->estado = !$nota->estado;
        $nota->save();        
        $this->dispatch('actualizarCards');
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
        if($this->notaId == null){
            $this->mensaje = "nota registrado exitosamente";
        }
        else{
            $this->mensaje = "nota actualizado exitosamente";
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
                text: "No se pudo registrar la nota",
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
            $tipo = NotaContable::updateOrCreate(
                [
                    'id'=>$this->notaId,
                ],
                [
                    'descripcion' => $this->form->descripcion,
                    'codigo' => $this->form->codigo,
                    'cuenta_debe_id' => $this->form->cuenta_debe_id,
                    'cuenta_haber_id' => $this->form->cuenta_haber_id,
                    'fecha' => $this->form->fecha,
                    'tipo' => $this->form->tipo,
                    'monto_debe' => $this->form->monto_debe,
                    'monto_haber' => $this->form->monto_haber,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            $this->mensajedeExito();  
            $this->limpiarCampos();  
            $this->cerrarModal();
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
        
    }
    
    public function render()
    {
        $notas = NotaContable::when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })->paginate(10);
        return view('livewire.financiero-contable.contabilidad.notas-contables.table',['notas'=>$notas]);
    }
}
