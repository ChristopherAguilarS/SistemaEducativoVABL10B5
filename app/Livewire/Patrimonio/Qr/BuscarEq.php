<?php
namespace App\Livewire\Patrimonio\Qr;
use Livewire\Component;
use Livewire\WithPagination;
//--

class BuscarEq extends Component
{
    use WithPagination;
    protected $listeners = ['vInv'];

    public function vInv(){
        $this->dispatchBrowserEvent('show-form');
    }
    public function render(){
        return view('livewire.patrimonio.qr.buscar-eq');
    }
}