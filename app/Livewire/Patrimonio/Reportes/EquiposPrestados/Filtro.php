<?php
namespace App\Livewire\Patrimonio\Reportes\EquiposPrestados;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Patrimonio\Reportes\EquiposSituacionExport;
use App\Models\Patrimonio\Equipo;
use Livewire\Attributes\On;
class Filtro extends Component{
    public $equipos, $equipo;
    #[On('resetFiltroNombrePersona')]
    public function buscar(){
        $this->dispatch('rTabla', $this->equipo);
    }
    public function descargar(){
        return Excel::download(new EquiposSituacionExport($this->r_val, $this->anio, $this->inventariado), 'Inventario por Ambientes al '.date('d-m-Y').'.xlsx');
    }
    public function render(){
        $this->equipos = Equipo::where('prestamo', 1)
            ->get();
        return view('livewire.patrimonio.reportes.equipos-prestados.filtro');
    }
}