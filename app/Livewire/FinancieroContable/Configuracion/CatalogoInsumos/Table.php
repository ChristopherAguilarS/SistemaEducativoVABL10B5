<?php

namespace App\Livewire\FinancieroContable\Configuracion\CatalogoInsumos;
use App\Models\FinancieroContable\Insumo;
use App\Models\SubGenericaNivel2;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estado = 1, $cumple = 0, $r_val, $search, $perPage = 20;
    public function mount(){
        $this->subgenericas = SubGenericaNivel2::where('estado',1)->orderBy('descripcion')->get();
    }
    #[On('rTabla')]
    public function rTabla(){
        $this->render();
    }
    #[On('rTablaEstado')]
    public function rTablaEstado($est, $cumple){
        $this->estado = $est;
        $this->cumple = $cumple;
    }
    #[On('resetFiltroDocumentoPersona')]
    public function resetFiltroDocumentoPersona($doc){
        $this->r_val = "numeroDocumento like '".$doc."'";
    }
    #[On('resetFiltroNombrePersona')]
    public function resetFiltroNombrePersona($ap1, $ap2, $nom){
        $this->r_val = "(apellidoPaterno like '%".$ap1."%' and apellidoMaterno like '%".$ap2."%' and nombres like '%".$nom."%')";
    }
    public function render(){
        $data = Insumo::query()->leftjoin('log_catalogo_unidad_medida as um', 'um.id', 'log_insumos.catalogoUnidadMedida_id')
            ->select('log_insumos.id', 'log_insumos.nombre as insumo', 'um.nombre as medida', 'log_insumos.estado')
            ->where('tipo', 1);
        if ($this->estado != 2) {
            $data = $data->where('log_insumos.estado', $this->estado);
        }
        if($this->search){
            $data = $data->whereRaw("log_insumos.nombre like '%".$this->search."%'");
        }
        return view('livewire.financiero-contable.configuracion.catalogo-insumos.table',['posts' => $data->orderby('descripcion', 'asc')->paginate($this->perPage)]);
    }
}