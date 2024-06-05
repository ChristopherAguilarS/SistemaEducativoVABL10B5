<?php

namespace App\Livewire\Biblioteca\ReservasEntregas;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Biblioteca\LibroReserva;
use DB;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estado = 9, $perPage = 20, $search;
    #[On('rTabla')]
    public function rtabla($estado, $search){
        $this->estado = $estado;
        $this->search = $search;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function devolver($id){
        $this->dispatch('dev', [$id]);
    }
    public function render(){
        $data = LibroReserva::join('biblioteca_libros as bl', 'bl.id', 'biblioteca_libros_reservas.libro_id')
            ->join('biblioteca_catalogo_autores as a', 'a.id', 'bl.catalogo_autor_id')
            ->select('fecha_devolucion as devuelto', 'bl.id as idi', 'a.descripcion as autor', 'recojo_at', 'entrega_at', 'biblioteca_libros_reservas.created_at as solicitado', 'biblioteca_libros_reservas.estado', 'bl.nombre', 'biblioteca_libros_reservas.id', 'imagen', 'biblioteca_libros_reservas.valoracion');
        if($this->estado != 9){
            $data = $data->where('biblioteca_libros_reservas.estado', $this->estado);
        }
        if($this->search){
            $data = $data->whereRaw("(a.descripcion like '%".$this->search."%' or bl.nombre like '%".$this->search."%')");
        }
        $data = $data->get();
        return view('livewire.biblioteca.reservas-entregas.table',['posts' => $data]);
    }
}