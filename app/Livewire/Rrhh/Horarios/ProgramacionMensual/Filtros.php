<?php

namespace App\Http\Livewire\Rrhh\Horarios\ProgramacionMensual;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Administracion\Local;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Logistica\Categoria;
use App\Exports\VehiculosExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
class Filtros extends Component
{
    use LivewireAlert;
    public $selectEstado = 2, $selectTipo, $selectLugar, $locales, $categorias;

    public function buscar()
    {
        $this->emit('rtabla', $this->selectLugar, $this->selectTipo, $this->selectEstado);
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
        return Excel::download(new VehiculosExport($this->selectLugar, $this->selectTipo, $this->selectEstado), 'Vehiculos '.date('d-m-Y').'.xlsx');
    }
    public function render()
    {
        $this->categorias = Categoria::where('tipo', 3)->where('estado',1)->get();
        if (auth()->user()->master == 1) {
            $this->locales = Local::where('estado', 1)->where('tipo', 0)->get();
        }else{
            $this->locales = Local::join('users_locales as l', 'l.local_id', 'adm_locales.id')->where('adm_locales.estado', 1)->where('adm_locales.tipo', 0)->get();
        }
        return view('livewire.rrhh.horarios.programacion-mensual.filtros');
    }
}
