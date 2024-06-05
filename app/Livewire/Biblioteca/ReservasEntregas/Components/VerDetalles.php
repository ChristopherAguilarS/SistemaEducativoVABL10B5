<?php
namespace App\Livewire\Biblioteca\ReservasEntregas\Components;

use App\Models\Biblioteca\LibroReserva;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Biblioteca\Libro;
class VerDetalles extends Component {
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $state = ['libro' =>'', 'autor' =>'', 'imagen' =>'', 'estado' => 0], $entrega = ['fecha' => null, 'hora' => null, 'observaciones' => '', 'estado' => 0], $idSel;

    #[On('ver')]
    public function ver($id){
        $this->idSel = $id;
        $this->titulo = "Visualización de Libro";
        $this->state = Libro::join('biblioteca_libros_reservas as bl', 'bl.libro_id', 'biblioteca_libros.id')
            ->join('biblioteca_catalogo_autores as a', 'biblioteca_libros.catalogo_autor_id', 'a.id')
            ->select('biblioteca_libros.nombre as libro', 'biblioteca_libros.id as idi', 'imagen', 'a.descripcion as autor', 'bl.created_at as fecha_solicitud', 'bl.estado', 'canceled_at', 'recojo_at', 'entrega_at')
            ->where('bl.id', $id)
            ->first()
            ->toArray();
            $this->entrega['fecha'] = date('d/m/Y h:i a', strtotime($this->state['fecha_solicitud']));
            $this->entrega['cancelacion'] = date('d/m/Y h:i a', strtotime($this->state['canceled_at']));
            $this->entrega['recojo'] = date('d/m/Y h:i a', strtotime($this->state['recojo_at']));
            $this->entrega['devolucion'] = date('d/m/Y h:i a', strtotime($this->state['entrega_at']));
            $this->entrega['estado'] = $this->state['estado'];
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function guardar(){
        $this->validate(['entrega.fecha' => 'required', 'entrega.hora' => 'required']);
        $sav = LibroReserva::find($this->idSel);
        $sav->estado = 3;
        $sav->entrega_by = auth()->user()->id;
        $sav->entrega_at = $this->entrega['fecha'].' '.$this->entrega['hora'];
        $sav->entrega_observaciones = $this->entrega['observaciones'];
        $sav->save();
        
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.biblioteca.reservas-entregas.components.ver-detalles');
    }
}
