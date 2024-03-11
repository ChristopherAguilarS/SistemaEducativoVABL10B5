<?php

namespace App\Http\Livewire\Rrhh\Asistencias\PermisosLicencias\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Exports\VehiculosExport;
class Exportar extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['exportar' => 'ver'];
    public $showModal = false, $checks = [];

    public function ver(){
        $this->showModal = true;
    }
    public function descargar(){
        return Excel::download(new VehiculosExport($this->selectLugar, $this->selectCategoria, $this->selectEstado), 'Vehiculos '.date('d-m-Y').'.xlsx');
    }
    public function render() {
        return view('livewire.rrhh.asistencias.permisos-licencias.components.exportar');
    }
}
