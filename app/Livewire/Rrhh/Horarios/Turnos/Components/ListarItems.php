<?php

namespace App\Livewire\Rrhh\Horarios\Turnos\Components;

use App\Models\FinancieroContable\PedidoDetalle;
use App\Models\FinancieroContable\PedidoDetalleTemp;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\FinancieroContable\IngresoDetalleTemp;
use App\Models\FinancieroContable\Almacen;
use App\Models\FinancieroContable\Tarea;
use App\Models\FinancieroContable\CompraDetalleTemp;
use App\Models\FinancieroContable\Insumo;
use DB;
class ListarItems extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $state = ['partida_id' =>0], $tp, $almacen_id,$search,$titulo, $tipo = 1, $partidas;
    public function guardar(){
        dd($this->almacen_id);
    }
    public function render(){
        $this->partidas = Tarea::get();
        $items = Insumo::get();
        
        return view('livewire.rrhh.horarios.turnos.listar-items', ['items' => $items]);
    }
}
