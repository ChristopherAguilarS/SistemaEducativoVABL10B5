<?php

namespace App\Livewire\Rrhh\Personal\Escalafon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
class Table extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sel = 0, $m = 0, $url, $idSel;

    public function vSel($id, $id2){
        if($id == 1){
            $this->url = 'ficha';
        }elseif($id == 2){
            $this->url = 'dni';
        }elseif($id == 3){
            $this->url = 'pregrado';
        }elseif($id == 4){
            $this->url = 'colegiatura';
        }elseif($id == 5){
            $this->url = 'postgrado';
        }elseif($id == 6){
            $this->url = 'otros-estudios';
        }elseif($id == 7){
            $this->url = '';
        }elseif($id == 8){
            $this->url = 'comisiones';
        }elseif($id == 9){
            $this->url = 'vacaciones';
        }elseif($id == 10){
            $this->url = 'licencias';
        }elseif($id == 11){
            $this->url = 'permisos';
        }elseif($id == 12){
            $this->url = 'experiencia-laboral';
        }
        $this->sel = $id;
        $this->m = $id2;
    }
    #[On('rTablaEstado')]
    public function rTablaEstado($id){
        $this->idSel = $id;
    }
    public function render(){
        return view('livewire.rrhh.personal.escalafon.table');
    }
}