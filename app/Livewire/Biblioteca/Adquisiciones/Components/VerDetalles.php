<?php
namespace App\Livewire\Biblioteca\Adquisiciones\Components;

use App\Models\Biblioteca\CatalogoCategoria;
use App\Models\Biblioteca\CatalogoEditorial;
use App\Models\Biblioteca\CatalogoIdioma;
use App\Models\Biblioteca\CatalogoMateria;
use App\Models\Biblioteca\CatalogoTipoIngreso;
use App\Models\Biblioteca\Libro;
use App\Models\Biblioteca\LibroMateria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Biblioteca\CatalogoAutor;
use Livewire\WithFileUploads;
class VerDetalles extends Component {
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $titulo,  $editar = false, $state = ['descripcion' =>'', 'estado' =>1], $catalogo, $tipo, $idDel, $selMat = 0;
    public $autores, $editoriales, $idiomas, $ingresos, $preview = false, $Foto, $libroSel, $categorias, $vMaterias, $materias, $idSel, $existe;
    public $urlFoto = 'sin_foto.jpeg';
    public function mount(){
        $this->autores = CatalogoAutor::where('estado', 1)->get();
        $this->editoriales = CatalogoEditorial::where('estado', 1)->get();
        $this->idiomas = CatalogoIdioma::where('estado', 1)->get();
        $this->ingresos = CatalogoTipoIngreso::where('estado', 1)->get();
        $this->categorias = CatalogoCategoria::where('estado', 1)->get();
        $this->materias = CatalogoMateria::where('estado', 1)->get();
    }
    public function updatedFoto(){
        $this->validate([          
         //   'Foto' => 'mimes:jfif,jpeg,jpg,bmp,png|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
            'Foto' => 'mimes:jfif,jpeg,jpg,bmp,png',
        ],
        [
            'Foto.mimes' => 'EL tipo de la foto no es compatible',
            'Foto.dimensions' => 'Las dimensiones de la foto es muy grande',
        ]);
        $this->preview = true;
    }
    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->selMat = 0;
        $this->tipo = $tipo;
        $this->editar = false;
        $this->preview = false;
        $this->urlFoto = 'sin_foto.jpeg';
        $this->Foto = null;
        if($tipo == 1){
            $this->titulo = "Ingreso de Libro";
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Libro";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Libro";
        }
        if($id){
            $this->libroSel = Libro::find($id);
            $this->vMaterias = LibroMateria::join('biblioteca_catalogo_materias as bc', 'bc.id', 'biblioteca_libros_materias.catalogo_materia_id')
                ->select('biblioteca_libros_materias.id', 'bc.descripcion')
                ->where('libro_id', $id)->get();
            $this->state = $this->libroSel->toArray();
            if($tipo == 3){
                $this->editar = $id;
            }
            if($this->state['imagen']){
                $rutaCompleta = public_path('images/libros/'.$this->editar.'.'.$this->state['imagen']);
                if (!file_exists($rutaCompleta)) {
                    $this->existe = false;
                    $this->urlFoto = 'sin_foto.jpeg';
                }else{
                    $this->existe = true;
                    $this->urlFoto = $this->editar.'.'.$this->state['imagen'];
                }
            }else{
                $this->urlFoto = 'sin_foto.jpeg';   
            }
            $this->idSel = $id;
        }else{
            $this->state = ['nombre' =>'', 'descripcion' =>'', 'catalogo_autor_id' =>0, 'catalogo_editorial_id' =>0, 'catalogo_idioma_id' =>0, 'catalogo_tipo_ingreso_id' =>0, 'catalogo_categoria_id'=>0, 'anio' =>'', 'ISBN' =>'', 'estado' =>1, 'imagen' =>''];
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('delCat')]
    public function delCat($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el catalogo #'.($id), 'funcion' => 'brCat']);
    }
    #[On('brCat')]
    public function brCat(){
        $del1 = CatalogoAutor::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function delMat($id){
        $del1 = LibroMateria::where('id', $id)->delete();
        $this->vMaterias = LibroMateria::join('biblioteca_catalogo_materias as bc', 'bc.id', 'biblioteca_libros_materias.catalogo_materia_id')
            ->select('biblioteca_libros_materias.id', 'bc.descripcion')
            ->where('libro_id', $this->idSel)->get();
        $this->dispatch('alert_info', ['mensaje' => 'Materia Retirada Correctamente']);
    }
    public function aniadir(){
        $sav = LibroMateria::updateOrCreate([
            'libro_id' => $this->idSel,
            'catalogo_materia_id' => $this->selMat
        ], [
            'libro_id' => $this->idSel,
            'catalogo_materia_id' => $this->selMat,
            'created_by' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $this->vMaterias = LibroMateria::join('biblioteca_catalogo_materias as bc', 'bc.id', 'biblioteca_libros_materias.catalogo_materia_id')
            ->select('biblioteca_libros_materias.id', 'bc.descripcion')
            ->where('libro_id', $this->idSel)->get();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Materia Añadido Correctamente']);
    }
    public function guardar(){
        $this->validate([
            'state.catalogo_tipo_ingreso_id' => 'required|not_in:0', 
            'state.nombre' => 'required',
            'state.catalogo_autor_id' => 'required',
            'state.catalogo_editorial_id' => 'required',
            'state.catalogo_idioma_id' => 'required',
            'state.catalogo_categoria_id' => 'required',
            'state.anio' => 'required'
        ]);
        $ruta = 'images/libros/';
        if ($this->Foto) {
            $file = $this->Foto->getClientOriginalName();
            $extension = pathinfo($file, PATHINFO_EXTENSION);
        }else{
            if(!$this->existe){
                $extension = null;
            }
        }
        if($this->editar){
            
            if ($this->Foto) {
                $nombre = $this->editar.'.'.$extension;
                $this->libroSel->imagen = $extension;
                $this->Foto->storeAs($ruta, $nombre, 'public');
            }
            $this->libroSel->catalogo_tipo_ingreso_id = $this->state['catalogo_tipo_ingreso_id'];
            $this->libroSel->nombre = $this->state['nombre'];
            $this->libroSel->descripcion = $this->state['descripcion'];
            $this->libroSel->catalogo_autor_id = $this->state['catalogo_autor_id'];
            $this->libroSel->catalogo_editorial_id = $this->state['catalogo_editorial_id'];
            $this->libroSel->catalogo_idioma_id = $this->state['catalogo_idioma_id'];
            $this->libroSel->catalogo_categoria_id = $this->state['catalogo_categoria_id'];
            $this->libroSel->anio = $this->state['anio'];
            $this->libroSel->ISBN = $this->state['ISBN'];
            $this->libroSel->estado = $this->state['estado'];
            $this->libroSel->updated_by = auth()->user()->id;
            $this->libroSel->updated_at =date('Y-m-d H:i:s');
            
            $this->libroSel->save();
            $this->dispatch('alert_info', ['mensaje' => 'Libro editado correctamente']);
        }else{
            
            $this->state['imagen'] = $extension;
            $this->state['estado'] = 1;
            $this->state['valoracion'] = 0;
            $this->state['reservado_por '] = 0;
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $sav = Libro::create($this->state);
            if($sav){
                if($this->Foto){
                    $nombre = $sav->id.'.'.$extension;
                    $this->Foto->storeAs($ruta, $nombre, 'public');
                }
            }            
            $this->dispatch('alert_info', ['mensaje' => 'Libro registrado correctamente']);
        }
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
    }
    public function render(){
        return view('livewire.biblioteca.adquisiciones.components.ver-detalles');
    }
}
