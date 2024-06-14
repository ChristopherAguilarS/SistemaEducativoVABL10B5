<?php

namespace App\Livewire\Configuracion\Contable\SaldoInicial;

use App\Livewire\Forms\CrearSaldoInicialAnualForm;
use App\Models\Cuenta;
use App\Models\SaldoInicialAnual;
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
    public $añoSeleccionado;
    public $años = ['2023','2024','2025','2026','2027','2028','2029','2030','2031','2032','2033'];
    public $cuentaId;
    public $cuentas;
    public $saldoInicialId;
    public $titulo;
    public $mensaje;
    public CrearSaldoInicialAnualForm $form;

    #[On('enviarAñoSeleccionado')]
    public function recogerAñoSeleccionado($año){
        $this->añoSeleccionado = $año;
        $this->form->año = $año;
        $this->render();
    }

    #[On('agregar')]
    public function agregar(){
        $this->cuentaId = null;
        //$this->limpiarCampos();
        $this->titulo = 'Crear Nueva Saldo Inicial a la cuenta';
    }

    public function mount(){
        $this->añoSeleccionado = Carbon::now()->year;
        $this->cuentas = Cuenta::where('estado',1)->get();
        $this->form->año = Carbon::now()->year;
    }

    public function guardar(){
        $this->form->validate();
        try {
            $saldoInicial = SaldoInicialAnual::updateOrCreate(
                [
                    'id'=>$this->saldoInicialId,
                ],
                [
                    'año' => $this->form->año,
                    'cuenta_id' => $this->form->cuenta_id,
                    'saldo_inicial_debe'=>$this->form->saldo_inicial_debe,
                    'saldo_inicial_haber'=>$this->form->saldo_inicial_haber,
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
    public function mensajedeExito()
    {
        if($this->saldoInicialId == null){
            $this->mensaje = "Saldo Inicial registrado exitosamente";
        }
        else{
            $this->mensaje = "Saldo Inicialactualizado exitosamente";
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
                text: "No se pudo registrar el Saldo Inicial",
                className: "danger",
                style:{
                    background: 'red'
                }
            }).showToast();
        JS);
    }

    public function render()
    {
        $saldos = SaldoInicialAnual::where('estado',1)->where('año',$this->añoSeleccionado)->paginate(10);
        return view('livewire.configuracion.contable.saldo-inicial.table',['saldos'=>$saldos]);
    }
}
