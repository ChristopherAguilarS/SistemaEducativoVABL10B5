<?php

namespace App\Livewire\Rrhh\Personal;

use App\Models\RecursosHumanos\Persona;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class VerDetalles extends Component
{
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $state = [], $editar = false, $idDel, $ficha, $dni, $existe1, $reemplaza1, $existe2, $reemplaza2, $idSel, $foto, $urlFoto = 'images/1.jpeg';
    #[On('nuevo')]
    public function onNuevo($id = 0){
        if($id){
            $this->titulo = "Editar Personal";
            $this->state = Persona::select('imagen', 'tipoDocumento', 'numeroDocumento', 'sexo', 'nombres', 'apellidoPaterno', 'apellidoMaterno', 'fechaNacimiento', 'estadoCivil', 'telefonos', 'lugar_nacimiento', 'email', 'direccion')
                ->find($id)->toarray();

            $this->urlFoto = 'legajos/'.$id.'/foto.'.$this->state['imagen'];
            
            $rutaCompleta = public_path($this->urlFoto);
            if (!file_exists($rutaCompleta)) {
                if($this->state['sexo'] == 1){
                    $this->urlFoto = 'images/1.jpeg';
                }else{
                    $this->urlFoto = 'images/2.jpg';
                }
            }
            $this->editar = $id;
        }else{
            $this->titulo = "Nuevo Personal";
            $this->state = ['tipoDocumento' => 0, 'numeroDocumento' => '', 'sexo' => 1, 'nombres' => '', 'apellidoPaterno' => '', 'apellidoMaterno' => '', 'fechaNacimiento' => '', 'estadoCivil' => 0, 'telefonos' => '', 'lugar_nacimiento' => '', 'email' => '', 'direccion' => ''];
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
            if ($this->foto) {
                $file = $this->foto->getClientOriginalName();
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $this->state['imagen'] = $extension;
            }
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
                    $pers->imagen = $this->state['imagen'];
                    $pers->direccion = $this->state['direccion'];
                    $pers->updated_by = auth()->user()->id;
                    $pers->updated_at = date('Y-m-d');
                $pers->save();
                $this->idSel = $pers->id;
            }else{
                $this->idSel = $this->editar;
                $this->state['estado'] = 0;
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d');
                $nivel = Persona::create($this->state);
            }
            if ($this->ficha) {
                $file = $this->ficha->getClientOriginalName();
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $nombre = 'ficha.'.$extension;
                $this->ficha->storeAs('legajos/'.$this->idSel.'/',$nombre, 'public');
            }
            if ($this->dni) {
                $file = $this->dni->getClientOriginalName();
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $nombre = 'dni.'.$extension;
                $this->dni->storeAs('legajos/'.$this->idSel.'/',$nombre, 'public');
            }
            if ($this->foto) {
                $nombre = 'foto.'.$extension;
                $this->foto->storeAs('legajos/'.$this->idSel.'/',$nombre, 'public');
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
