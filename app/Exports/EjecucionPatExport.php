<?php

namespace App\Exports;

use App\Models\ObjetivoEstrategico;
use App\Models\PlanAnualTrabajo;
use App\Models\Tarea;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EjecucionPatExport implements FromView
{
    public $añoSeleccionado;

    public function __construct($añoSeleccionado)
    {
        $this->añoSeleccionado = $añoSeleccionado;
    }

    public function view(): View
    {
        $planes_anuales = PlanAnualTrabajo::where('año_academico_id',$this->añoSeleccionado)->pluck('id');
        $objetivos = ObjetivoEstrategico::when($this->añoSeleccionado, function ($query) use($planes_anuales) {
            $query->whereIn('plan_anual_trabajo_id', $planes_anuales);
        })
        ->with('acciones_estrategicas_priorizadas.actividades_operativas.indicadores.tareas_ejecutadas')->get();
        return view('export.ejecucion-pat', [
            'objetivos' => $objetivos,
        ]);
    }

    public function sheet($sheet)
    {
        $sheet->setAutoSize(true);
    }
}
