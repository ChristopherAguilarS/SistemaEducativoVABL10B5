<?php

namespace App\Livewire\FinancieroContable\Presupuestal\ResumenEjecucion;

use App\Models\AñoAcademico;
use App\Models\MovimientoCajaChica;
use App\Models\Tarea;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Exports\EjecucionPatExport;
use App\Exports\ResumenPatExport;
use App\Models\Indicador;
use App\Models\PlanAnualTrabajo;
use Maatwebsite\Excel\Facades\Excel;

class Filtro extends Component
{
    public $fecha_inicio;
    public $fecha_fin;
    public $apertura = false;
    public $cierre = false;
    public $años;
    public $añoSeleccionado;
    public $objetivoSeleccionado;
    public $actividadSeleccionada;
    public $indicadorSeleccionado;

    public function mount(){
        $fecha = Carbon::now();
        $año = $fecha->year;
        $añoAcademicoSeleccionado = AñoAcademico::where('año',$año)->first();  
        $this->añoSeleccionado = optional($añoAcademicoSeleccionado)->id;
        $this->años = AñoAcademico::where('estado', 1)->get();
    }

    public function updatedFechaInicio(){
        $this->dispatch('actualizarFechas',$this->fecha_inicio,$this->fecha_fin);
    }

    public function updatedFechaFin(){
        $this->dispatch('actualizarFechas',$this->fecha_inicio,$this->fecha_fin);
    }

    public function exportEjecucion()
    {
        return Excel::download(new EjecucionPatExport($this->añoSeleccionado), 'ejecucion-pat.xlsx');
    }

    public function exportResumen()
    {
        return Excel::download(new ResumenPatExport($this->añoSeleccionado), 'resumen-pat.xlsx');
    }

    public function agregar(){
        $this->dispatch('agregar');
    }

    public function aperturaCC(){
        $this->dispatch('apertura');
    }

    public function cierreCC(){
        $this->dispatch('cierre');
    }

    #[On('enviarObjetivoEstrategico')]
    public function recibirObjetivoSeleccionado($objetivoSeleccionado){
        $this->objetivoSeleccionado = $objetivoSeleccionado;
    }

    #[On('enviarActividadOperativa')]
    public function recibirActividadSeleccionado($actividadSeleccionada){
        $this->actividadSeleccionada = $actividadSeleccionada;
    }

    #[On('reiniciarTareas')]
    public function reiniciarTareas(){
        $this->render();
    }

    public function updatedAñoSeleccionado(){
        $this->render();
    }

    #[On('actualizarCardsPrincipal')]
    #[On('actualizarCards')]
    public function render()
    {
        $planes_anuales = PlanAnualTrabajo::where('año_academico_id',$this->añoSeleccionado)->pluck('id');
        $monto_presupuestado = Indicador::when($this->añoSeleccionado, function ($query) use($planes_anuales) {
            return $query->whereHas('actividad_operativa.accion_estrategica_priorizada.objetivo_estrategico', function ($query) use($planes_anuales){
                $query->whereIn('plan_anual_trabajo_id', $planes_anuales);
            });
        })
        ->when($this->objetivoSeleccionado, function ($query) {
            return $query->whereHas('actividad_operativa.accion_estrategica_priorizada', function ($query) {
                $query->where('objetivo_id', $this->objetivoSeleccionado);
            });
        })
        ->when($this->actividadSeleccionada, function ($query) {
            return $query->whereHas('actividad_operativa', function ($query) {
                $query->where('accion_estrategica_priorizada_id', $this->actividadSeleccionada);
            });
        })
        ->when($this->indicadorSeleccionado, function ($query) {
            return $query->where('indicador_id', $this->indicadorSeleccionado);
        })->sum('monto_asignado');
        $monto_ejecutado = Indicador::when($this->añoSeleccionado, function ($query) use($planes_anuales) {
            return $query->whereHas('actividad_operativa.accion_estrategica_priorizada.objetivo_estrategico', function ($query) use($planes_anuales){
                $query->whereIn('plan_anual_trabajo_id', $planes_anuales);
            });
        })
        ->when($this->objetivoSeleccionado, function ($query) {
            return $query->whereHas('actividad_operativa.accion_estrategica_priorizada', function ($query) {
                $query->where('id', $this->objetivoSeleccionado);
            });
        })
        ->when($this->actividadSeleccionada, function ($query) {
            return $query->whereHas('actividad_operativa', function ($query) {
                $query->where('id', $this->actividadSeleccionada);
            });
        })->sum('monto_ejecutado');
        return view('livewire.financiero-contable.presupuestal.resumen-ejecucion.filtro',['monto_ejecutado'=>$monto_ejecutado,'monto_presupuestado'=>$monto_presupuestado]);
    }
}
