<?php
namespace App\Livewire\Biblioteca\Inicio\Components\Libros;
use App\Models\Biblioteca\LibroReserva;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Biblioteca\Libro;
use DB;
class ListadoLibros extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $categoria, $materia, $perPage = 20;
    #[On('rTabla')]
    public function rtabla($search, $categoria, $materia){
        $this->search = $search;
        $this->categoria = $categoria;
        $this->materia = $materia;
    }
    #[On('rTabla2')]
    public function rTabla2(){
        $this->render();
    }
    #[On('reservar')]
    public function reservar($id){
        try{
            DB::beginTransaction();
                $sav = Libro::find($id);
                if(!$sav->reservado_por){
                    $sav->reservado_por = auth()->user()->id;
                    $sav->save();
                    $sav2 = LibroReserva::create([
                        'persona_id' => auth()->user()->id,
                        'libro_id' => $id,
                        'estado' => 1,
                        'created_by' => auth()->user()->id,
                        'created_at' =>  date('Y-m-d H:i:s')
                    ]);

                    $this->dispatch('alert_success', ['mensaje' => 'Libro reservado correctamente']);
                    $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
                }else{
                    $this->dispatch('alert_warning', ['mensaje' => 'El Libro ya fue reservado']);
                }
                
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            $this->dispatch('alert_danger', ['mensaje' => 'Ocurrio un error inesperado.']);
        }
        
    }
    #[On('devolver')]
    public function devolver($id){
        $this->dispatch('verModal', ['id' => 'form2', 'accion' => 'hide']);
        $this->dispatch('dev', [$id]);
    }
    public function render(){
        $data = Libro::with(['autor'])->whereRaw('(reservado_por = 0 or reservado_por = '.auth()->user()->id.')');
        if($this->categoria){
            $data = $data->where('catalogo_categoria_id', $this->categoria);
        }
        if($this->search){
            $data = $data->whereRaw("nombre like '%". $this->search."%'");
        }
        if($this->materia){
            //$data = $data->where('catalogo_categoria_id', $this->categoria);
        }
        $data = $data->orderby('nombre', 'asc')->paginate($this->perPage);
        return view('livewire.biblioteca.inicio.components.libros.listado-libros',['posts' => $data]);
    }
}