<?php

namespace App\Livewire\FinancieroContable\Configuracion\CatalogoInsumos;

use App\Models\FinancieroContable\Insumo;
use App\Models\FinancieroContable\CatalogoUnidadMedida;
use App\Models\FinancieroContable\Categoria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $trabajadores,$state = [], $equipos, $categorias, $selEquipo = 1, $selectEstado = 2, $unidades, $selectLugar, $locales, $almacenes, $estadoFoto , $preview, $file, $Foto, $urlFoto, $val = ['equipo' => '', 'marca' => '', 'categoria' => '', 'sucursal' => '', 'almacen' => ''];
    public $idR, $nombre, $tipo = 1, $editar = false, $btnCrear = 'Crear Categoría';
    
    protected $rules = [
        'state.nombre' => 'required',
        'state.catalogoUnidadMedida_id' => 'required'
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function verImagen(){
        $data = Insumo::select('imagen')->where('id', $this->state['catalogoEquipos_id'])->first();
        $existe = Storage::disk('public')->exists('images/CatalogoEquipos/'.$this->state['catalogoEquipos_id'].'.'.$data->imagen);

        if ($existe) {
            $this->estadoFoto = true;
            $this->urlFoto = 'CatalogoEquipos/'.$this->state['catalogoEquipos_id'].'.'.$data->imagen;
        }else{
            $this->estadoFoto = false;
            $this->urlFoto = null;
        }
    }
    public function buscar(){
        $this->dispatch('rtabla', $this->selectLugar, $this->selectAlmacen, $this->selectEstado);
    }
    #[On('eliminar')]
    public function eliminar($id){
        $this->idR = $id;
        $this->confirm('¿Desea eliminar el Insumo #'.$this->idR.'?', [
            'onConfirmed' => 'borrarInsumo',
            'confirmButtonText' => 'Eliminar',
            'cancelButtonText' => 'Cancelar',
        ]);
    }
    #[On('borrarInsumo')]
    public function borrarInsumo(){
        $data = Insumo::where('id',$this->idR)->first();
        $data->delete();
        $del = Storage::disk('public')->delete('images/CatalogoInsumos/'.$this->idR.'.'.$data->imagen);
        $this->dispatch('renderizar');
        $this->dispatch('alert_info', ['mensaje' => 'Insumo eliminada correctamente']);
    }
    #[On('editar')]
    public function editar($id){
        $this->titulo = 'Edición de Insumos';
        $data = Insumo::select('id', 'nombre', 'descripcion', 'catalogoCategoria_id', 'stockMinimo', 'catalogoUnidadMedida_id', 'imagen', 'modelo', 'estado', 'costo', 'codigo_insumo')->where('id',$id)->first();
        
        if ($data->catalogoUnidadMedida_id) {
            $this->unidades = CatalogoUnidadMedida::where('estado', 1)->orderByRaw("case when id=".$data->catalogoUnidadMedida_id." then -1 else id end ASC")->get();
        }else{
            $this->unidades = CatalogoUnidadMedida::where('estado', 1)->get();
        }
         $this->categorias = Categoria::where('estado', 1)->where('tipo', 2)->get();
        
        $this->state = [
            'id' => $id, 
            'nombre' => $data->nombre, 
            'descripcion' => $data->descripcion, 
            'catalogoCategoria_id' => $data->catalogoCategoria_id, 
            'stockMinimo' => $data->stockMinimo, 
            'catalogoUnidadMedida_id' => $data->catalogoUnidadMedida_id, 
            'imagen' => $data->imagen, 
            'modelo' => $data->modelo, 
            'estado' => $data->estado, 
            'costo' => $data->costo, 
            'codigo_insumo' => $data->codigo_insumo
        ];

        $existe = Storage::disk('public')->exists('images/insumos/'.$id.'.'.$data->imagen);
        $urlf = 'Insumos/'.$id.'.'.$data->imagen;

        
        if ($existe) {
            $this->estadoFoto = true;
            $this->urlFoto = $urlf;
        }else{
            $this->estadoFoto = false;
            $this->urlFoto = null;
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
        $this->editar = true;
        $this->btnCrear = 'Editar Insumo';
    }
    #[On('nuevo')]
    public function nuevo(){
        $this->titulo = 'Ingreso de Insumo';
        $this->state = ['nombre'=>null, 'descripcion' => null, 'catalogoCategoria_id' => null, 'stockMinimo' => 0, 'catalogoUnidadMedida_id' => 1, 'imagen' => null, 'modelo' => '', 'estado' => 1];
        $this->tipo = 1;
        $this->categorias = Categoria::where('estado', 1)->where('tipo', 2)->get();
        $this->unidades = CatalogoUnidadMedida::where('estado', 1)->get();
        $this->estadoFoto = false;
        $this->Foto = null;
        $this->preview = false;
        $this->urlFoto = null;
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
        $this->editar = false;
        $this->btnCrear = 'Crear Insumo';
    }

    public function guardar(){
        $data = null;
        $validatedData = $this->validate();
        if ($this->editar) {
            $duplicidad = 0;
            if($duplicidad>0){
                $this->dispatch('alert_danger', ['mensaje' => 'El código ingresado ya se encuentra registrado.']);
            }else{
                if ($this->Foto) {
                    $file = $this->Foto->getClientOriginalName();
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    $nombre = $this->state['id'].'.'.$extension;
                    $this->Foto->storeAs('images/insumos/',$nombre,'public');
                }else{
                    $extension = null;
                }
                $data = Insumo::find($this->state['id']);
                    $data->nombre = $this->state['nombre'];
                    $data->descripcion = $this->state['descripcion'];
                    $data->catalogoCategoria_id = $this->state['catalogoCategoria_id'];
                    $data->stockMinimo = $this->state['stockMinimo'];
                    $data->catalogoUnidadMedida_id = $this->state['catalogoUnidadMedida_id'];                 
                    $data->imagen = $extension;
                    $data->modelo = $this->state['modelo'];
                    $data->estado = $this->state['estado'];
                    $data->codigo_insumo = $this->state['codigo_insumo'];
                    $data->updated_by = auth()->user()->id;
                    $data->updated_at = date('Y-m-d H:i:s');
                $data->save();
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
                $this->dispatch('renderizar');
                $this->dispatch('alert_info', ['mensaje' => 'Insumo actualizado correctamente']);
            }
        }else{
            $existe = Insumo::where('nombre', $this->state['nombre'])->get()->count();
            if ($existe>0) {
                $this->dispatch('alert_danger', ['mensaje' => 'El nombre ingresado ya se encuentra registrado.']);
            }else{
                
                $this->state['tipo'] = $this->tipo;
                $this->state['created_by'] = auth()->user()->id;
                $this->state['created_at'] = date('Y-m-d H:i:s');
                $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
                if ($this->Foto) {
                    if ($data) {
                        $file = $this->Foto->getClientOriginalName();
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                        $this->state['imagen'] = $extension;
                        $nombre = $data->id.'.'.$extension;
                        $this->Foto->storeAs('images/insumos/',$nombre,'public');
                    }
                }
                $data = Insumo::create($this->state);
                $this->dispatch('renderizar');
                $this->dispatch('alert_info', ['mensaje' => 'Producto creado correctamente']);
            }
        }
    }
    public function render(){
        return view('livewire.financiero-contable.configuracion.catalogo-insumos.ver-detalles');
    }
}
