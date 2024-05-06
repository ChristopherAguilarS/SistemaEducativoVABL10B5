<?php
namespace App\Livewire\Biblioteca\Libros\Components;

use App\Models\Biblioteca\Libro;
use App\Models\Biblioteca\LibroReserva;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class Devolver extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $descripcion, $rating =0, $idSel;

    #[On('dev')]
    public function devolver($id){
        $this->idSel = $id;
        $this->rating = 0;
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    
    public function guardar(){
        $this->validate(['descripcion' => 'required']);
        $busq1 = Libro::where('id', $this->idSel)->update(['reservado_por' => 0]);
        $busq2 = LibroReserva::where('libro_id', $this->idSel)
            ->where('persona_id', auth()->user()->id)
            ->where('estado', 1)
            ->update([
                'valoracion' => $this->rating,
                'opinion' => $this->descripcion
            ]);
        $this->dispatch('alert_success', ['mensaje' => 'Libro devuelto correctamente']);
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
     public function setRating($value) {
        $this->rating = $value;
    }
    public function render(){
        return view('livewire.biblioteca.libros.components.devolver');
    }
}
