<?php
namespace App\Livewire\Biblioteca\EntregaLibros\Components;

use App\Models\Biblioteca\LibroReserva;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Biblioteca\Libro;
class Entrega extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $state = ['libro' =>'', 'autor' =>'', 'imagen' =>''], $entrega = ['fecha' => null, 'hora' => null, 'observaciones' => ''], $idSel;

    #[On('entrega')]
    public function entrega($id){
        $this->idSel = $id;
        $this->titulo = "Entrega de Libro";
        $this->state = Libro::join('biblioteca_libros_reservas as bl', 'bl.libro_id', 'biblioteca_libros.id')
            ->join('biblioteca_catalogo_autores as a', 'biblioteca_libros.catalogo_autor_id', 'a.id')
            ->select('biblioteca_libros.nombre as libro', 'biblioteca_libros.id as idi', 'imagen', 'a.descripcion as autor')
            ->where('bl.id', $id)
            ->first()
            ->toArray();
            $this->entrega['fecha'] = date('Y-m-d');
            $this->entrega['hora'] = date('H:i');
        $this->dispatch('verModal', ['id' => 'form3', 'accion' => 'show']);
    }
    public function guardar(){
        $this->validate(['entrega.fecha' => 'required', 'entrega.hora' => 'required']);
        $sav = LibroReserva::find($this->idSel);
        $sav->estado = 2;
        $sav->recojo_by = auth()->user()->id;
        $sav->recojo_at = $this->entrega['fecha'].' '.$this->entrega['hora'];
        $sav->recojo_observaciones = $this->entrega['observaciones'];
        $sav->save();
        
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form3', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.biblioteca.entrega-libros.components.entrega');
    }
}
