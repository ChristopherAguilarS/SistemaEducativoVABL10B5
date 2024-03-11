<?php

namespace App\Http\Livewire\Rrhh\Asistencias\TareoObra\Components;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Rrhh\TareoObraImport;
use Livewire\WithFileUploads;
class Subir extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    protected $listeners = ['verSubir' => 'ver'];
    public $showModal = false, $file, $ambito;
    public function ver(){
        $this->showModal = true;
    }
    public function importar(){
        /*  $this->validate([
              'file'=>'required|mimes:xls, xlsx'
          ]);
          */
          if ($this->file) {
              $import = Excel::import(new TareoObraImport($this->ambito), $this->file);
              if ($import) {
                    $this->alert('success', 'Asistencia(s) subidas correctamente');
              }else{
                  dd(2);
              }
              $this->emit("rTabla");
          }else{
                $this->alert('success', 'Asistencia(s) subidas correctamente');
                $this->dispatchBrowserEvent('info', ['texto' => 'No has seleccionado un formato válido', 'footer' => 'Seleccione un archivo', 'icon' => 'warning']);
          }
          $this->showModal = false;
      }
    public function render() {
        return view('livewire.rrhh.asistencias.tareo-obra.components.subir');
    }
}