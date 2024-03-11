<?php

namespace App\Http\Livewire\Rrhh\Configuracion\AprobacionTipo;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use DB;
use Illuminate\Support\Facades\Mail;
class VerDetalles extends Component
{
    use LivewireAlert;
    protected $listeners = ['nuevo' => 'ver', 'borrar', 'eliminar'];
    public $titulo, $correo, $showModal, $areas;
    public function ver($id){
        $this->showModal = true;
    }
    public function guardar() {
        try{
            $for = $this->correo;
            $subject = "SARHA - PROCESO LIQUIDACION";
            $env = Mail::send('livewire.rrhh.trabajadores.contratos-ceses.components.mensaje-liquidacion',['trabajador' => '[nombre_trabjador]', 'cargo' => '[cargo]','proyecto'=>'[nombre_proyecto]', 'cese' => date('Y-m-d'), 'tipoCese' => '[tipo_cese]'], function($msj) use($subject,$for){
                $msj->from(config('conf.'.config('conf.tipo').'.env_correo'), config('conf.'.config('conf.tipo').'.nombre-comercial')." - SARHA");
                $msj->subject($subject);
                $msj->to($for);
            });
            if($env){
                $this->alert('success', 'Correo de prueba enviado correctamente');
            }
        }catch(\Exception $e){
            DB::rollback();
            $this->alert('error', 'Ocurrio un error inesperado.');
        }
    }
    public function render() {
        return view('livewire.rrhh.configuracion.aprobacion-tipo.ver-detalles');
    }
}
