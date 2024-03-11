<?php

namespace App\Http\Livewire\Rrhh\Horarios\ConfiguracionHorario;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Exports\VehiculosExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
class Filtros extends Component
{
    use LivewireAlert;
    public $selectEstado = 1;

    public function buscar()
    {
        $this->emit('rtabla', $this->selectEstado);
    }
    public function buscarDocumento($doc, $id){
        if ($doc == 'SOAT') {
            $ruta = 'images/Vehiculos/Soats/'.$id.'.pdf';
            $nom = 'SOAT';           
        }else{
            $ruta = 'images/Vehiculos/Seguros/'.$id.'.pdf';
            $nom = 'SEGURO';
        }    
        
        if(Storage::disk('public')->exists($ruta)){
            $file = Storage::disk('public')->get($ruta);
            return (new Response($file,200))->header('Content-Type','application/pdf')->header('Content-Disposition','inline; filename="'.$nom.'"');
        }else{
            $ruta2 = 'images/Vehiculos/no_encontrado.pdf';
            $file = Storage::disk('public')->get($ruta2);
            return (new Response($file,200))->header('Content-Type','application/pdf');
        }
    }
    public function descargar()
    {
        return Excel::download(new VehiculosExport($this->selectLugar, $this->selectCategoria, $this->selectEstado), 'Vehiculos '.date('d-m-Y').'.xlsx');
    }
    public function render()
    {
        return view('livewire.rrhh.horarios.configuracion-horario.filtros');
    }
}
