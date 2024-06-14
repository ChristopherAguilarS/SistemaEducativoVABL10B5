<?php

namespace App\Livewire\FinancieroContable\Pedidos\CrearRequerimientos;

use App\Livewire\Forms\CrearDetalleRequerimientoForm;
use App\Livewire\Forms\CrearRequerimientoCajaBancoForm;
use App\Livewire\Forms\CrearRequerimientoForm;
use App\Models\ActividadOperativa;
use App\Models\Cuenta;
use App\Models\Indicador;
use App\Models\Item;
use App\Models\ObjetivoEstrategico;
use App\Models\RecursosHumanos\Persona;
use App\Models\Requerimiento;
use App\Models\RequerimientoCajaBanco;
use App\Models\RequerimientoItem;
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
    public $requerimientoId;
    public $requerimientoT;
    public $titulo;
    public $tituloDetalle;
    public $indicadores = [];
    public $objetivos_estrategicos;
    public $objetivo_estrategico_id;
    public $actividad_operativa_id;
    public $actividades_operativas = [];
    public $indicador_id;
    public $indicadorP;
    public CrearRequerimientoForm $form;
    public CrearDetalleRequerimientoForm $formDetalle;
    public $bienes;

    public $fecha_inicio;
    public $fecha_fin;
    public $selectedOption;
    public $items;
    public $responsables;

    public function mount(){
        $this->indicadores = Indicador::where('estado',1)->orderBy('descripcion')->get();
        $this->responsables = Persona::where('estado',1)->get();
        $this->updatedFormTipoPedido();
        $this->bienes = [];
    }

    public function updatedFormTipoPedido(){
        if($this->form->tipo_pedido == '2'){
            $this->items = Item::whereHas('familia.clase.grupo', function ($query) {
                $query->where('tipo_adquisicion_id', 2);
            })->take(10)->get();
        }
        else{
            $this->items = Item::whereHas('familia.clase.grupo', function ($query) {
                $query->where('tipo_adquisicion_id', 1);
            })->take(10)->get();
        }
    }

    public function actualizarIndicador(){
        $this->indicadorP = Indicador::find($this->form->indicador_id);
    }

    #[On('actualizarFechas')]
    public function actualizarFechas($fecha_inicio,$fecha_fin){
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    #[On('agregar')]
    public function agregar(){
        $this->requerimientoId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nuevo requerimiento';
    }

    public function editar($id){
        $requerimiento = Requerimiento::find($id);
        $this->titulo = 'Editar Requerimiento - '.optional($requerimiento)->descripcion;
        $this->requerimientoId = $id;
        $this->form->descripcion = $requerimiento->descripcion;
        $this->form->indicador_id = $requerimiento->indicador_id;
        $this->form->responsable_id = $requerimiento->responsable_id;
        $this->form->fecha_registro_requerimiento = $requerimiento->fecha_registro_requerimiento;
        $this->form->comentarios = $requerimiento->comentarios;
        $this->form->tipo_pedido = $requerimiento->tipo_pedido;
        $this->dispatch('cambiarSeleccion', id: $requerimiento->cuenta_id);
    }

    public function agregarDetalle(){
        $this->tituloDetalle = 'Agregar nuevo Item';
    }

    public function guardarDetalle(){
        $this->formDetalle->validate();
        $a = [];
        $a['item_id'] = $this->formDetalle->item_id;
        $a['cantidad_solicitada'] = $this->formDetalle->cantidad_solicitada;
        $a['especificaciones'] = $this->formDetalle->especificaciones;
        array_push($this->bienes,$a);
        $this->formDetalle->reset();
        $this->cerrarModalDetalle();
        $this->abrirModal();
        $this->mensajedeExitoDetalle();
    }

    public function mostrarUnidad($id){
        $bien = Item::find($id);
        if($bien != null){
            return $bien->unidad_medida->descripcion;
        }
    }

    public function mostrarDescripcion($id){
        $bien = Item::find($id);
        if($bien != null){
            return $bien->descripcion;
        }
    }

    public function mostrarCodigo($id){
        $bien = Item::find($id);
        if($bien != null){
            return $bien->familia->clase->grupo->codigo.'.'.$bien->familia->clase->codigo.'.'.$bien->familia->codigo.'.'.$bien->codigo;
        }
    }

    public function cambiarEstado($id){
        $requerimiento = Requerimiento::find($id);
        $requerimiento->estado = !$requerimiento->estado;
        $requerimiento->save();        
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
    public function cerrarModalDetalle()
    {
       
        $this->js(<<<'JS'
            $('#myModalDetalle').modal('hide')
        JS);
    }

    #[Js] 
    public function abrirModal()
    {
       
        $this->js(<<<'JS'
            $('#myModal').modal('show')
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
        if($this->requerimientoId == null){
            $this->mensaje = "requerimiento registrado exitosamente";
        }
        else{
            $this->mensaje = "requerimiento actualizado exitosamente";
        }
        $this->js(<<<'JS'
            Toastify({
                text: $wire.mensaje,
                className: "info"
            }).showToast();
        JS);
    }

    #[Js] 
    public function mensajedeExitoDetalle()
    {
        if($this->requerimientoId == null){
            $this->mensaje = "item agregado exitosamente";
        }
        else{
            $this->mensaje = "item actualizado exitosamente";
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
                text: "No se pudo registrar la requerimiento",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }



    public function guardar(){
        $this->form->validate();
        $requerimiento = Requerimiento::latest()->first();
        if($requerimiento != null){
            $nro_requerimiento = $requerimiento->id + 1;
        }
        else{
            $nro_requerimiento = 0;
        }
        try {
            $requerimiento = Requerimiento::updateOrCreate(
                [
                    'id'=>$this->requerimientoId,
                ],
                [
                    'nro_requerimiento' => 'R'.$nro_requerimiento,
                    'descripcion' => $this->form->descripcion,
                    'responsable_id' => $this->form->responsable_id,
                    'indicador_id' => $this->form->indicador_id,
                    'fecha_registro_requerimiento' => $this->form->fecha_registro_requerimiento,
                    'tipo_pedido' => $this->form->tipo_pedido,
                    'estado_proceso' => 1,
                    'estado' => 1,
                    'created_by' => Auth::user()->id
                ]);
            foreach ($this->bienes as $key => $bien) {
                $requerimientoTemp = RequerimientoItem::where('requerimiento_id',$requerimiento->id)->where('item_id',$bien['item_id'])->where('estado',1)->first();
                $bienT = RequerimientoItem::updateorCreate(
                    [
                        'id'=>optional($requerimientoTemp)->id,
                    ],
                    [
                        'item_id' => $bien['item_id'],
                        'requerimiento_id' => $requerimiento->id,
                        'cantidad' => $bien['cantidad'],
                        'especificaciones' => $bien['especificaciones'],
                        'estado' => 1,
                        'created_by' => Auth::user()->id
                    ]);
            }
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
        $requerimientos = Requerimiento::when($this->fecha_inicio != null, function ($query) {
            return $query->where('fecha','>=',$this->fecha_inicio);
        })
        ->when($this->fecha_fin != null, function ($query) {
            return $query->where('fecha','<=',$this->fecha_fin);
        })->paginate(10);
        return view('livewire.financiero-contable.pedidos.crear-requerimientos.table',['requerimientos'=>$requerimientos]);
    }
}
