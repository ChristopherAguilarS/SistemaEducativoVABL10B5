<?php
namespace App\Livewire\Biblioteca\ReservasEntregas\Components;

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
        $this->rating = 5;
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    
    public function guardar(){
        $this->validate(['descripcion' => 'required']);
        $busq = LibroReserva::find($this->idSel);
        $busq->opinion = $this->descripcion;
        $busq->valoracion = $this->rating;
        $busq->save();
        $this->dispatch('alert_success', ['mensaje' => 'Libro valorado correctamente']);
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
    }
     public function setRating($value) {
        $this->rating = $value;
    }
    public function render(){
        return view('livewire.biblioteca.reservas-entregas.components.devolver');
    }
}
