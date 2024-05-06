<?php
namespace App\Livewire\Biblioteca\Libros\Components;

use App\Models\Biblioteca\Libro;
use App\Models\Biblioteca\LibroReserva;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class VerMas extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state, $rImagen;

    #[On('ver')]
    public function ver($id){
        $this->state = Libro::with(['autor', 'materias'])->find($id);
        if($this->state->imagen){
            $this->rImagen = $this->state->id.'.'.$this->state->imagen;
        }else{
            $this->rImagen = 'sin_foto.jpeg';
        }
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function render(){
        return view('livewire.biblioteca.libros.components.ver-mas');
    }
}
