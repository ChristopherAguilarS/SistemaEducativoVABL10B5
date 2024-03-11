<?php

namespace App\Http\Livewire\Rrhh\Inicio;
use DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Rrhh\VinculoLaboral;
use App\Models\Administracion\Local;
class ProyectosFinalizados extends Component
{
    use LivewireAlert;
    public function render(){
        $liquidaciones = VinculoLaboral::join('rrhh_personas as p', 'p.id', 'rrhh_vinculo_laboral.persona_id')
            ->join('adm_locales as l', 'l.id', 'rrhh_vinculo_laboral.local_id')
            ->select('l.id', 'p.id as pers')
            ->Where('l.estado', 0)
            ->Where('rrhh_vinculo_laboral.estado', 1)
            ->get();
        $proys = $liquidaciones->pluck('id');
        $proyectos = Local::whereIn('id', $proys)->get();
        return view('livewire.rrhh.inicio.proyectos-finalizados', ['liquidaciones' => $liquidaciones, 'proyectos'=> $proyectos]);
    }
}
