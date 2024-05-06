<?php

namespace App\Livewire\Biblioteca\ReservasEntregas;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Biblioteca\LibroReserva;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $estado = 1, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($estado){
        $this->estado = $estado;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    public function render(){
        $data = LibroReserva::join('biblioteca_libros as bl', 'bl.id', 'biblioteca_libros_reservas.libro_id')
            ->join('users as u', 'u.id', 'bl.reservado_por')
            ->select('fecha_devolucion as devuelto', 'biblioteca_libros_reservas.created_at as solicitado', 'biblioteca_libros_reservas.estado', 'bl.nombre', 'biblioteca_libros_reservas.id', 'u.name as usuario')
            ->get();
        return view('livewire.biblioteca.reservas-entregas.table',['posts' => $data]);
    }
}