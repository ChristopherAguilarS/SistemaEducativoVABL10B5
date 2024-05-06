<?php
namespace App\Livewire\Patrimonio\Configuracion\Familias\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\Patrimonio\Familia;
use Livewire\WithFileUploads;
class VerDetalles extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $urlFoto = '', $Foto, $preview, $nombreEquipo, $idEquipo;

    #[On('ver')]
    public function ver($id, $nombre){
        $this->nombreEquipo = $nombre;
        $this->idEquipo = $id;
        $data = Familia::find($this->idEquipo);
        $this->urlFoto = $data->grupo.$data->clase.$data->familia.'.'.$data->imagen;
        $rutaCompleta = public_path('images/equipamiento/catalogo_equipos/'.$this->urlFoto);

        if (!file_exists($rutaCompleta)) {
            $this->urlFoto = 'sin_foto.jpeg';
        }
        $this->preview = false;
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('eliminar')]
    public function updatedFoto(){
        $this->validate([          
            'Foto' => 'mimes:jfif,jpeg,jpg,bmp,png|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
        ],
        [
            'Foto.mimes' => 'EL tipo de la foto no es compatible',
            'Foto.dimensions' => 'Las dimensiones de la foto es muy grande',
        ]);
        $this->preview = true;
    }
    public function guardar(){

        if($this->Foto != null){
            $data = Familia::find($this->idEquipo);
            $file = $this->Foto->getClientOriginalName();
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $nombre = $data->grupo.$data->clase.$data->familia.'.'.$extension;
            $ruta = 'images/equipamiento/catalogo_equipos/';                 
            $this->Foto->storeAs($ruta, $nombre, 'public');
            $data->imagen = $extension;
            $data->save();
            $this->dispatch('alert_info', ['mensaje' => 'Actualizado correctamente']);
        }
    }
    public function render(){
        return view('livewire.patrimonio.configuracion.familias.components.ver-detalles');
    }
}
