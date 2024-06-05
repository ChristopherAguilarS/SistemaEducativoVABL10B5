<?php
namespace App\Livewire\Patrimonio\Ambientes\Components;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\Patrimonio\CatalogoTipoAmbiente;
use App\Models\Patrimonio\CatalogoUbicacion;
use App\Models\Patrimonio\CatalogoUsoAmbiente;
use App\Models\Patrimonio\CatalogoTipoTecho;
use App\Models\Patrimonio\CatalogoPiso;
use App\Models\Patrimonio\CatalogoPabellon;
use App\Models\Patrimonio\Ambiente;
use App\Models\Patrimonio\CatalogoTipoPiso;
class VerDetalles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = ['nombre' => '', 'descripcion' => '', 'catalogo_tipo_ambiente_id' => 0, 'catalogo_ubicacion_id' => 0, 'catalogo_uso_ambiente_id' => 0, 'catalogo_condicion_id' => 0, 'aforo' => '', 'area' => '', 'pabellon' =>'', 'catalogo_piso_id'=>0, 'observaciones'=>''];
    public $tipos, $idDel, $ubicaciones, $usos, $techos, $tipos_pisos, $aforo, $area, $pabellon, $pisos, $observaciones, $tipo, $editar, $catalogo, $pabellones;

    public function mount(){
        $this->tipos = CatalogoTipoAmbiente::where('estado', 1)->get()->toArray();
        $this->ubicaciones = CatalogoUbicacion::where('estado', 1)->get()->toArray();
        $this->usos = CatalogoUsoAmbiente::where('estado', 1)->get()->toArray();
        $this->techos = CatalogoTipoTecho::where('estado', 1)->get()->toArray();
        $this->pisos = CatalogoPiso::where('estado', 1)->get()->toArray();
        $this->pabellones = CatalogoPabellon::where('estado', 1)->get()->toArray();
        $this->tipos_pisos = CatalogoTipoPiso::where('estado', 1)->get()->toArray();
    }
    #[On('nuevo')]
    public function ver($id, $tipo){
        $this->tipo = $tipo;
        $this->editar = false;
        if($tipo == 1){
            $this->titulo = "Nuevo Ambiente";
        }elseif($tipo == 2){
            $this->titulo = "Visualizacion de Ambiente";
        }elseif($tipo == 3){
            $this->titulo = "Edición de Ambiente";
        }
        if($id){
            $this->catalogo = Ambiente::find($id);
            $this->state = [
                'nombre' => $this->catalogo->nombre,
                'catalogo_tipo_ambiente_id' => $this->catalogo->catalogo_tipo_ambiente_id,
                'catalogo_pabellon_id' => $this->catalogo->catalogo_pabellon_id,
                'catalogo_piso_id' => $this->catalogo->catalogo_piso_id,
                'estado_conservacion' => $this->catalogo->estado_conservacion,
                'catalogo_uso_ambiente_id' => $this->catalogo->catalogo_uso_ambiente_id,
                'aforo' => $this->catalogo->aforo,
                'largo' => $this->catalogo->largo,
                'ancho' => $this->catalogo->ancho,
                'alto' => $this->catalogo->alto,
                'area' => $this->catalogo->area,
                'tipo_uso' => $this->catalogo->tipo_uso,
                'puertas' => $this->catalogo->puertas,
                'ventanas' => $this->catalogo->ventanas,
                'catalogo_tipo_techo_id' => $this->catalogo->catalogo_tipo_techo_id,
                'catalogo_tipo_piso_id' => $this->catalogo->catalogo_tipo_piso_id,
                'luces_emergencia' => $this->catalogo->luces_emergencia,
                'alarmas' => $this->catalogo->alarmas,
                'extintores' => $this->catalogo->extintores,
                'escritorios_total' => $this->catalogo->escritorios_total,
                'escritorios_buenos' => $this->catalogo->escritorios_buenos,
                'escritorios_regulares' => $this->catalogo->escritorios_regulares,
                'escritorios_malos' => $this->catalogo->escritorios_malos,
                'sillas_total' => $this->catalogo->sillas_total,
                'sillas_buenos' => $this->catalogo->sillas_buenos,
                'sillas_regulares' => $this->catalogo->sillas_regulares,
                'sillas_malos' => $this->catalogo->sillas_malos,
                'carpetas_total' => $this->catalogo->carpetas_total,
                'carpetas_buenos' => $this->catalogo->carpetas_buenos,
                'carpetas_regulares' => $this->catalogo->carpetas_regulares,
                'carpetas_malos' => $this->catalogo->carpetas_malos,
                'armarios_total' => $this->catalogo->armarios_total,
                'armarios_buenos' => $this->catalogo->armarios_buenos,
                'armarios_regulares' => $this->catalogo->armarios_regulares,
                'armarios_malos' => $this->catalogo->armarios_malos,
                'proyectores_total' => $this->catalogo->proyectores_total,
                'proyectores_buenos' => $this->catalogo->proyectores_buenos,
                'proyectores_regulares' => $this->catalogo->proyectores_regulares,
                'proyectores_malos' => $this->catalogo->proyectores_malos,
                'pizarras_total' => $this->catalogo->pizarras_total,
                'pizarras_buenos' => $this->catalogo->pizarras_buenos,
                'pizarras_regulares' => $this->catalogo->pizarras_regulares,
                'pizarras_malos' => $this->catalogo->pizarras_malos,
                'otros_total' => $this->catalogo->otros_total,
                'otros_buenos' => $this->catalogo->otros_buenos,
                'otros_regulares' => $this->catalogo->otros_regulares,
                'otros_malos' => $this->catalogo->otros_malos,
                'estado' => $this->catalogo->estado,
                'observaciones'=> $this->catalogo->observaciones
            ];
            if($tipo == 3){
                $this->editar = $id;
            }
        }else{
            $this->state = [
                'nombre' => '',
                'catalogo_tipo_ambiente_id' => 0,
                'catalogo_pabellon_id' => 0,
                'catalogo_piso_id' => 0,
                'estado_conservacion' => 0,
                'catalogo_uso_ambiente_id' => 0,
                'aforo' => NULL,
                'largo' => NULL,
                'ancho' => NULL,
                'alto' => NULL,
                'area' => NULL,
                'tipo_uso' => 1,
                'puertas' => 0,
                'ventanas' => 0,
                'catalogo_tipo_techo_id' => 0,
                'catalogo_tipo_piso_id' => 0,
                'luces_emergencia' => 0,
                'alarmas' => 0,
                'extintores' => 0,
                'escritorios_total' => 0,
                'escritorios_buenos' => 0,
                'escritorios_regulares' => 0,
                'escritorios_malos' => 0,
                'sillas_total' => 0,
                'sillas_buenos' => 0,
                'sillas_regulares' => 0,
                'sillas_malos' => 0,
                'carpetas_total' => 0,
                'carpetas_buenos' => 0,
                'carpetas_regulares' => 0,
                'carpetas_malos' => 0,
                'armarios_total' => 0,
                'armarios_buenos' => 0,
                'armarios_regulares' => 0,
                'armarios_malos' => 0,
                'proyectores_total' => 0,
                'proyectores_buenos' => 0,
                'proyectores_regulares' => 0,
                'proyectores_malos' => 0,
                'pizarras_total' => 0,
                'pizarras_buenos' => 0,
                'pizarras_regulares' => 0,
                'pizarras_malos' => 0,
                'otros_total' => 0,
                'otros_buenos' => 0,
                'otros_regulares' => 0,
                'otros_malos' => 0,
                'estado' => 1,
                'observaciones' => '',
            ];
        }
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'show']);
    }
    #[On('delAmb')]
    public function delAmb($id){
        $this->idDel = $id;
        $this->dispatch('confirmar', ['mensaje' => 'Confirmación de Eliminacion', 'detalle' => 'Se eliminara el Ambiente #'.($id), 'funcion' => 'brAmb']);
    }
    #[On('brAmb')]
    public function brCat(){
        $del1 = Ambiente::where('id', $this->idDel)->delete();
        $this->dispatch('rTabla2');
        $this->render();
        $this->dispatch('alert_info', ['mensaje' => 'Eliminado Correctamente']);
    }
    public function guardar(){
        if($this->editar){
            $this->catalogo->nombre = $this->state['nombre'];
            $this->catalogo->catalogo_tipo_ambiente_id = $this->state['catalogo_tipo_ambiente_id'];
            $this->catalogo->catalogo_pabellon_id = $this->state['catalogo_pabellon_id'];
            $this->catalogo->catalogo_piso_id = $this->state['catalogo_piso_id'];
            $this->catalogo->estado_conservacion = $this->state['estado_conservacion'];
            $this->catalogo->catalogo_uso_ambiente_id = $this->state['catalogo_uso_ambiente_id'];
            $this->catalogo->aforo = $this->state['aforo'];
            $this->catalogo->largo = $this->state['largo'];
            $this->catalogo->ancho = $this->state['ancho'];
            $this->catalogo->alto = $this->state['alto'];
            $this->catalogo->area = $this->state['area'];
            $this->catalogo->tipo_uso = $this->state['tipo_uso'];
            $this->catalogo->puertas = $this->state['puertas'];
            $this->catalogo->ventanas = $this->state['ventanas'];
            $this->catalogo->catalogo_tipo_techo_id = $this->state['catalogo_tipo_techo_id'];
            $this->catalogo->catalogo_tipo_piso_id = $this->state['catalogo_tipo_piso_id'];
            $this->catalogo->luces_emergencia = $this->state['luces_emergencia'];
            $this->catalogo->alarmas = $this->state['alarmas'];
            $this->catalogo->extintores = $this->state['extintores'];
            $this->catalogo->escritorios_total = $this->state['escritorios_total'];
            $this->catalogo->escritorios_buenos = $this->state['escritorios_buenos'];
            $this->catalogo->escritorios_regulares = $this->state['escritorios_regulares'];
            $this->catalogo->escritorios_malos = $this->state['escritorios_malos'];
            $this->catalogo->sillas_total = $this->state['sillas_total'];
            $this->catalogo->sillas_buenos = $this->state['sillas_buenos'];
            $this->catalogo->sillas_regulares = $this->state['sillas_regulares'];
            $this->catalogo->sillas_malos = $this->state['sillas_malos'];
            $this->catalogo->carpetas_total = $this->state['carpetas_total'];
            $this->catalogo->carpetas_buenos = $this->state['carpetas_buenos'];
            $this->catalogo->carpetas_regulares = $this->state['carpetas_regulares'];
            $this->catalogo->carpetas_malos = $this->state['carpetas_malos'];
            $this->catalogo->armarios_total = $this->state['armarios_total'];
            $this->catalogo->armarios_buenos = $this->state['armarios_buenos'];
            $this->catalogo->armarios_regulares = $this->state['armarios_regulares'];
            $this->catalogo->armarios_malos = $this->state['armarios_malos'];
            $this->catalogo->proyectores_total = $this->state['proyectores_total'];
            $this->catalogo->proyectores_buenos = $this->state['proyectores_buenos'];
            $this->catalogo->proyectores_regulares = $this->state['proyectores_regulares'];
            $this->catalogo->proyectores_malos = $this->state['proyectores_malos'];
            $this->catalogo->pizarras_total = $this->state['pizarras_total'];
            $this->catalogo->pizarras_buenos = $this->state['pizarras_buenos'];
            $this->catalogo->pizarras_regulares = $this->state['pizarras_regulares'];
            $this->catalogo->pizarras_malos = $this->state['pizarras_malos'];
            $this->catalogo->otros_total = $this->state['otros_total'];
            $this->catalogo->otros_buenos = $this->state['otros_buenos'];
            $this->catalogo->otros_regulares = $this->state['otros_regulares'];
            $this->catalogo->otros_malos = $this->state['otros_malos'];
            $this->catalogo->estado = $this->state['estado'];
            $this->catalogo->observaciones = $this->state['observaciones'];
            $this->catalogo->updated_by = auth()->user()->id;
            $this->catalogo->updated_at = date('Y-m-d H:i:s');
            $this->catalogo->save();
        }else{
            $this->state['created_by'] = auth()->user()->id;
            $this->state['created_at'] = date('Y-m-d H:i:s');
            $eq = Ambiente::create($this->state);
        }
        
        $this->dispatch('rTabla2');
        $this->dispatch('verModal', ['id' => 'form1', 'accion' => 'hide']);
        $this->dispatch('alert_info', ['mensaje' => 'Ambiente Añadido Correctamente']);
    }
    public function render(){
        return view('livewire.patrimonio.ambientes.components.ver-detalles');
    }
}
