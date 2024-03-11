<?php

namespace App\Http\Livewire\Rrhh\Asistencias\Asistencia;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Logistica\CatalogoVehiculo;
use App\Models\Logistica\VehiculoRotacion;
use App\Models\Administracion\Local;
use App\Models\Logistica\Almacen;
use App\Models\Logistica\CatalogoColor;
use App\Models\Logistica\CatalogoCombustible;
use App\Models\Logistica\Categoria;
use App\Models\Logistica\Vehiculo;
use App\Models\Logistica\CatalogoVehiculoClase;
use App\Models\Logistica\Equipo;
use App\Models\Logistica\Marca;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use App\Models\Rrhh\Persona;
use Illuminate\Support\Facades\Storage;

class VerDetalles extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    protected $listeners = ['editar' => 'editar', 'eliminar' => 'eliminar', 'borrar', 'nuevo' => 'nuevo'];
    public $titulo, $state = [], $idp, $estadoFoto , $preview, $file, $Foto, $urlFoto, $tipo = 1;
    public $idR, $tituloEdit = 'Sucursal/Proyecto', $nombreEdit;

    public $showModal = false;
    public $editar = false;
    public $btnCrear = 'Crear Categoría';

    protected $rules = [
        'state.catalogoVehiculo_id' => 'required',
        'state.catalogoCategoria_id' => 'required',
        'state.placa' => 'required',
        'state.anioFabricacion' => 'required',
        'state.destino_id' => 'required'
    ];
    protected $messages = [
        'state.anioFabricacion.required' => '*Campo Requerido'
    ];
    public function updatedFoto(){
        $this->preview = false;
        $validatedData = $this->validate([          
            'Foto' => 'mimes:jfif,jpeg,jpg,bmp,png|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
        ],
        [
            'Foto.mimes' => 'EL tipo de la foto no es compatible',
            'Foto.dimensions' => 'Las dimensiones de la foto es muy grande',
        ]);
        $this->preview = true;
    }
    public function personal(){
        $this->tipo = 1;
    }
    public function laboral(){
        $this->tipo = 2;
    }
    public function profesional(){
        $this->tipo = 3;
    }
    public function familiares(){
        $this->tipo = 4;
    }
    public function capacitaciones(){
        $this->tipo = 5;
    }
    public function verImagen()
    {
        $data = CatalogoEquipo::select('imagen')->where('id', $this->state['catalogoEquipos_id'])->first();
        $existe = Storage::disk('public')->exists('images/CatalogoEquipos/'.$this->state['catalogoEquipos_id'].'.'.$data->imagen);

        if ($existe) {
            $this->estadoFoto = true;
            $this->urlFoto = $this->state['catalogoEquipos_id'].'.'.$data->imagen;
        }else{
            $this->estadoFoto = false;
            $this->urlFoto = null;
        }
    }

    public function buscar()
    {
        $this->emit('rtabla', $this->selectLugar, $this->selectAlmacen, $this->selectEstado);
    }

    public function eliminar($id){
        $this->idR = $id;
        $this->confirm('¿Desea eliminar el Equipo?', [
            'onConfirmed' => 'borrar',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }

    public function borrar(){
        $data = CatalogoEquipo::where('id',$this->idR)->first();
        $data->delete();
        $del = Storage::disk('public')->delete('images/CatalogoEquipos/'.$this->idR.'.'.$data->imagen);
        $this->emit('renderizar');
        $this->alert('success', 'Equipo eliminada correctamente');
    }

    public function editar($id){
        $this->titulo = 'Editar Vehiculo';
        $data = Vehiculo::select('log_vehiculos.id', 'log_vehiculos.catalogoVehiculo_id', 'log_vehiculos.catalogoCategoria_id', 'log_vehiculos.placa', 'log_vehiculos.anioFabricacion', 'log_vehiculos.anioModelo', 'log_vehiculos.modelo', 'log_vehiculos.catalogoMarca_id', 'log_vehiculos.catalogoCombustible_id', 'log_vehiculos.serieMotor', 'log_vehiculos.serieChasis', 'log_vehiculos.catalogoColor_id', 'log_vehiculos.pesoNeto', 'log_vehiculos.pesoBruto', 'log_vehiculos.catalogoVehiculoClase_id', 'log_vehiculos.partidaRegistral', 'log_vehiculos.estado', 'log_vehiculos.pasajeros', 'log_vehiculos.cilindrada', 'log_vehiculos.fechaCompra', 'log_vehiculos.numeroFactura', 'log_vehiculos.imagen', 'destino_id', 'tipoDestino')
            ->leftjoin('log_vehiculos_rotaciones as lr', function ($join) {
                $join->on('lr.vehiculo_id', '=', 'log_vehiculos.id')
                    ->where('lr.estado', 1);
            })
            ->join('log_catalogo_vehiculos as lc', 'lc.id', 'log_vehiculos.catalogoVehiculo_id')
            ->where('log_vehiculos.id',$id)->first();

        $rotacion = VehiculoRotacion::select('la.id as local_id', 'log_vehiculos_rotaciones.destino_id')->join('adm_locales as la', 'la.id', 'log_vehiculos_rotaciones.destino_id')->where('log_vehiculos_rotaciones.estado', 1)->where('log_vehiculos_rotaciones.vehiculo_id', $id)->first();
        
        if ($data->tipoDestino) {
            $lugar = Local::where('id', $data->destino_id)->first();
            $this->tituloEdit ='Sucursal/Proyecto';
        }else{
            $lugar = Persona::select(\DB::raw("CONCAT(apellidoPaterno, ' ', apellidoMaterno, ', ', nombres) AS nombre"), 'id')->where("id", $data->destino_id)->first();
             $this->tituloEdit ='Trabajador';
        }
        $this->nombreEdit = $lugar->nombre;
        $this->state = [
            'id' => $data->id,
            'catalogoVehiculo_id' => $data->catalogoVehiculo_id,
            'catalogoCategoria_id' => $data->catalogoCategoria_id,
            'placa' => $data->placa,
            'anioFabricacion' => $data->anioFabricacion,
            'anioModelo' => $data->anioModelo,
            'modelo' => $data->modelo,
            'catalogoMarca_id' => $data->catalogoMarca_id,
            'catalogoCombustible_id' => $data->catalogoCombustible_id,
            'serieMotor' => $data->serieMotor,
            'serieChasis' => $data->serieChasis,
            'catalogoColor_id' => $data->catalogoColor_id,
            'pesoNeto' => $data->pesoNeto,
            'pesoBruto' => $data->pesoBruto,
            'catalogoVehiculoClase_id' => $data->catalogoVehiculoClase_id,
            'partidaRegistral' => $data->partidaRegistral,
            'estado' => $data->estado,
            'pasajeros' => $data->pasajeros,
            'cilindrada' => $data->cilindrada,
            'fechaCompra' => $data->fechaCompra,
            'numeroFactura' => $data->numeroFactura,
            'imagen' => $data->imagen
        ];
        
        $color_id = $data->catalogoColor_id?$data->catalogoColor_id:'0';
        $this->vehiculos = CatalogoVehiculo::where('estado', 1)->orderByRaw("case when id=".$data->catalogoVehiculo_id." then -1 else id end ASC")->get();
        $this->marcas = Marca::where('estado', 1)->where('tipo',3)->orderByRaw("case when id=".$data->catalogoMarca_id." then -1 else id end ASC")->get();
        $this->categorias = Categoria::where('estado', 1)->where('tipo',3)->orderByRaw("case when id=".$data->catalogoCategoria_id." then -1 else id end ASC")->get();
        $this->clases = CatalogoVehiculoClase::where('estado', 1)->orderByRaw("case when id=".$data->catalogoVehiculoClase_id." then -1 else id end ASC")->get();
        $this->colores = CatalogoColor::where('estado', 1)->orderByRaw("case when id=".$color_id." then -1 else id end ASC")->get();
        $this->combustibles = CatalogoCombustible::where('estado', 1)->orderByRaw("case when id=".$data->catalogoCombustible_id." then -1 else id end ASC")->get();

      //  $this->selectLugar = $data->local_id;
        $this->state['destino_id'] = $data->destino_id;
        //$this->locales = Local::join('users_locales as l', 'l.local_id', 'adm_locales.id')->orderByRaw("case when adm_locales.id=".$rotacion->local_id." then -1 else adm_locales.id end ASC")->get();
        $existe = false;
        if ($data->imagen) {
            $existe = Storage::disk('public')->exists('images/Vehiculos/'.$id.'.'.$data->imagen);
            $urlf = 'Vehiculos/'.$id.'.'.$data->imagen;
        }
        

        if ($existe) {
            $this->estadoFoto = true;
            $this->urlFoto = $urlf;
        }else{
            $this->estadoFoto = false;
            $this->urlFoto = null;
        }
        $this->showModal = true;
        $this->editar = true;
        $this->btnCrear = 'Editar Vehiculo';
    }

    public function nuevo(){
        $this->titulo = 'Nuevo Personal';
        $this->state = ['catalogoVehiculo_id' => null, 'catalogoCategoria_id' => null, 'placa' => null, 'anioFabricacion' => null, 'anioModelo' => null, 'modelo' => null, 'catalogoMarca_id' => 0, 'catalogoCombustible_id' => 0, 'serieMotor' => '', 'serieChasis' => null, 'catalogoColor_id' => null, 'pesoNeto' => null, 'pesoBruto' => null, 'catalogoVehiculoClase_id' => 0, 'partidaRegistral' => null, 'estado' => 1, 'pasajeros' => null, 'cilindrada' => null, 'fechaCompra' => null, 'numeroFactura' => null, 'imagen' => null];
        $this->vehiculos = CatalogoVehiculo::where('estado', 1)->get();
        $this->marcas = Marca::where('estado', 1)->where('tipo',3)->get();
        $this->categorias = Categoria::where('estado', 1)->where('tipo',3)->get();
        $this->clases = CatalogoVehiculoClase::where('estado', 1)->get();
        $this->colores = CatalogoColor::where('estado', 1)->get();
        $this->combustibles = CatalogoCombustible::where('estado', 1)->get();
        if (auth()->user()->master == 1) {
            $this->locales = Local::where('estado', 1)->get();
        }else{
            $this->locales = Local::join('users_locales as l', 'l.local_id', 'adm_locales.id')->where('adm_locales.estado', 1)->get();
        }
        $this->estadoFoto = false;
            $this->urlFoto = null;
        $this->showModal = true;
        $this->editar = false;
        $this->btnCrear = 'Crear Personal';
    }

    public function fotoCatalogo(){
        $this->Foto = null;
        $existe = Storage::disk('public')->exists('images/CatalogoEquipos/'.$this->state['catalogoEquipos_id'].'.'.$this->state['imagen']);
        $urlf = 'CatalogoEquipos/'.$this->state['catalogoEquipos_id'].'.'.$this->state['imagen'];

        if ($existe) {
            $this->estadoFoto = true;
            $this->urlFoto = $urlf;
        }else{
            $this->estadoFoto = false;
            $this->urlFoto = null;
        }
    }

    public function guardar()
    {
        $validatedData = $this->validate();
        if ($this->editar) {
            $existe = Vehiculo::where('placa', $this->state['placa'])->whereNotIn('id', [$this->state['id']])->get()->count();
            if($existe>0){
                $this->alert('warning', 'El número de placa ingresado ya se encuentra registrado.');
            }else{
                if ($this->Foto) {
                    $file = $this->Foto->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = $this->state['id'].'.'.$extension;
                    $this->state['imagen'] = $extension;
                    $this->Foto->storeAs('images/Vehiculos/',$nombre,'public');
                }else{
                    $extension = null;
                }
                $data = Vehiculo::find($this->state['id']);
                    $data->catalogoVehiculo_id = $this->state['catalogoVehiculo_id'];
                    $data->catalogoCategoria_id = $this->state['catalogoCategoria_id'];
                    $data->placa = $this->state['placa'];
                    $data->anioFabricacion = $this->state['anioFabricacion'];
                    $data->anioModelo = $this->state['anioModelo'];
                    $data->modelo = $this->state['modelo'];
                    $data->catalogoMarca_id = $this->state['catalogoMarca_id'];
                    $data->catalogoCombustible_id = $this->state['catalogoCombustible_id'];
                    $data->serieMotor = $this->state['serieMotor'];
                    $data->serieChasis = $this->state['serieChasis'];
                    $data->catalogoColor_id = $this->state['catalogoColor_id'];
                    $data->pesoNeto = $this->state['pesoNeto'];
                    $data->pesoBruto = $this->state['pesoBruto'];
                    $data->catalogoVehiculoClase_id = $this->state['catalogoVehiculoClase_id'];
                    $data->partidaRegistral = $this->state['partidaRegistral'];
                    $data->estado = $this->state['estado'];
                    $data->pasajeros = $this->state['pasajeros'];
                    $data->cilindrada = $this->state['cilindrada'];
                    $data->fechaCompra = $this->state['fechaCompra'];
                    $data->numeroFactura = $this->state['numeroFactura'];
                    $data->imagen = $this->state['imagen'];
                    $data->updated_by = auth()->user()->id;
                    $data->updated_at = date('Y-m-d H:i:s');
                $data->save();
                $this->showModal = false;
                $this->emit('renderizar');
                $this->alert('success', 'Vehiculo actualizado correctamente');
            }
            
        }else{
            $existe = Vehiculo::where('placa', $this->state['placa'])->get()->count();
            if ($existe>0) {
                $this->alert('warning', 'El número de placa ingresado ya se encuentra registrado.');
            }else{
                
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d H:i:s');
                $this->showModal = false;
                if ($this->Foto) {
                    $this->state['imagen'] = $extension;
                }
                $data = Vehiculo::create($this->state);
                if ($this->Foto) {
                    $file = $this->Foto->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = $data->id.'.'.$extension;
                    $this->Foto->storeAs('images/Vehiculos/',$nombre,'public');
                }
                
                if ($data) {
                    $rotacion['vehiculo_id'] = $data->id;
                    $rotacion['destino_id'] = $this->state['destino_id'];
                    $rotacion['tipoDestino'] = 1;
                    $rotacion['tipoOrigen'] = 0;
                    $rotacion['origen_id'] = 0;
                    $rotacion['estado'] = 1;
                    $rotacion['fechaRotacion'] = date('Y-m-d H:i:s');
                    $rotacion['created_by'] = auth()->user()->id;
                    $rotacion['created_at'] = date('Y-m-d H:i:s');
                    $sav = VehiculoRotacion::create($rotacion);
                }
                $this->emit('renderizar');
                $this->alert('success', 'Equipo creado correctamente');
            }
        }
    }

    public function render()
    {
        
        
        return view('livewire.rrhh.asistencias.asistencia.ver-detalles');
    }
}
