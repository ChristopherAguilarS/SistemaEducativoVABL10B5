<?php

namespace App\Livewire\Rrhh\Personal;

use App\Models\RecursosHumanos\Persona;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = [], $editar = false, $idDel;
    #[On('nuevo')]
    public function onNuevo($id = 0){
        if($id){
            $this->titulo = "Editar Personal";
            $this->state = Persona::select('tipoDocumento', 'numeroDocumento', 'sexo', 'nombres', 'apellidoPaterno', 'apellidoMaterno', 'fechaNacimiento', 'estadoCivil', 'telefonos', 'lugar_nacimiento', 'email', 'direccion')
                ->find($id)->toarray();
            $this->editar = $id;
        }else{
            $this->titulo = "Nuevo Personal";
            $this->state = ['tipoDocumento' => 0, 'numeroDocumento' => '', 'sexo' => 0, 'nombres' => '', 'apellidoPaterno' => '', 'apellidoMaterno' => '', 'fechaNacimiento' => '', 'estadoCivil' => 0, 'telefonos' => '', 'lugar_nacimiento' => '', 'email' => '', 'direccion' => ''];
            $this->editar = false;
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('eliminar')]
    public function eliminar($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el nivel con codigo Nro.'.$id, 'funcion' => 'brNivel']);
    }
    #[On('brNivel')]
    public function brNivel(){
        $sav = Persona::find($this->idDel);
        $sav->delete();
        $this->dispatch('rTabla');
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        $this->validate([
            'state.numeroDocumento' => 'required',
            'state.tipoDocumento' => 'required|not_in:0',
            'state.nombres' => 'required',
            'state.apellidoPaterno' => 'required',
            'state.apellidoMaterno' => 'required',
            'state.fechaNacimiento' => 'required',
        ]);
        try {
            if($this->editar){
                $pers = Persona::find($this->editar);
                    $pers->tipoDocumento = $this->state['tipoDocumento'];
                    $pers->numeroDocumento = $this->state['numeroDocumento'];
                    $pers->sexo = $this->state['sexo'];
                    $pers->nombres = $this->state['nombres'];
                    $pers->apellidoPaterno = $this->state['apellidoPaterno'];
                    $pers->apellidoMaterno = $this->state['apellidoMaterno'];
                    $pers->fechaNacimiento = $this->state['fechaNacimiento'];
                    $pers->estadoCivil = $this->state['estadoCivil'];
                    $pers->telefonos = $this->state['telefonos'];
                    $pers->lugar_nacimiento = $this->state['lugar_nacimiento'];
                    $pers->email = $this->state['email'];
                    $pers->direccion = $this->state['direccion'];
                    $pers->updated_by = auth()->user()->id;
                    $pers->updated_at = date('Y-m-d');
                $pers->save();
            }else{
                $this->state['estado'] = 0;
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d');
                $nivel = Persona::create($this->state);
            }
            $this->dispatch('alert_info', ['mensaje' => 'Guardado Correctamente']);
            $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
            $this->dispatch('rTabla');
        } catch (\Exception $e) {
            dd($e);
           //$this->mensajedeError();
        }
    }
    public function render(){
        return view('livewire.rrhh.personal.ver-detalles');
    }
}
