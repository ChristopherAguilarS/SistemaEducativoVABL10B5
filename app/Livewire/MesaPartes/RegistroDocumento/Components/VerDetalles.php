<?php
namespace App\Livewire\MesaPartes\RegistroDocumento\Components;

use App\Models\Patrimonio\CatalogoEquipo;
use App\Models\Patrimonio\Equipo;
use App\Models\Patrimonio\EquipoInventario;
use App\Models\Patrimonio\EquipoPrestamo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\Patrimonio\Familia;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $urlFoto = '', $Foto, $preview, $nombreEquipo, $CODIGO_ACTIVO, $DESCRIPCION, $idSel;

    #[On('addEquipo')]
    public function ver($id){
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('eliminar')]
    public function updatedFoto(){
        $validatedData = $this->validate([          
            'Foto' => 'mimes:jfif,jpeg,jpg,bmp,png|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
        ],
        [
            'Foto.mimes' => 'EL tipo de la foto no es compatible',
            'Foto.dimensions' => 'Las dimensiones de la foto es muy grande',
        ]);
        $this->preview = true;
        $this->rutaFoto = null;
    }
    public function guardar(){
        $eq = Equipo::where('id', $this->idSel)->update(['prestamo' => 1]);
        
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
        $this->dispatch('alert_info', ['mensaje' => 'Equipo Añadido Correctamente']);
    }
    public function buscar($id){
        try{
            $grupo = substr($this->CODIGO_ACTIVO, 0, 2);
            $clase = substr($this->CODIGO_ACTIVO, 2, 2);
            $familia = substr($this->CODIGO_ACTIVO, 4, 4);
            $equipo =Equipo::where('CODIGO_ACTIVO',$this->CODIGO_ACTIVO)
                ->first();

            if($equipo){
                $this->DESCRIPCION = $equipo->DESCRIPCION;
                $this->idSel = $equipo->id;
                $this->confirma = 1;
                $this->urlFoto = 'images/equipamiento/catalogo_equipos/'.$grupo.$clase.$familia;
                $this->dispatch('alert_info', ['mensaje' => 'Equipo Encontrado']);
            }else{
                $this->familia =0;
                $this->confirma =0;
                $this->dispatch('alert_danger', ['mensaje' => 'Código patrimonial no encontrado']);
            }
        }catch(\Exception $e){dd($e);
            $this->familia =0;
            $this->confirma =0;
            $this->dispatch('alert_danger', ['mensaje' => 'Código patrimonial no encontrado']);
        }
    }
    public function render(){
        return view('livewire.mesa-partes.registro-documento.components.ver-detalles');
    }
}
