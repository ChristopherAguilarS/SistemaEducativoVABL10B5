<?php

namespace App\Livewire\Biblioteca\Fotochecks\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class Resumen extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $idPers;
    #[On('verResumen')]
    public function verResumen($id = 0){
        $this->idPers = $id;
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'show']);
    }
    public function render(){
        return view('livewire.biblioteca.fotochecks.components.resumen');
    }
}
