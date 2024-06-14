<?php

namespace App\Services;

use App\Models\Tarea;
use App\Models\TareaEjecutada;

class ActualizarMontoTareaService
{
    public function actualizarMontoTarea($id)
    {
        $tarea = Tarea::find($id);
        $monto = TareaEjecutada::where('tarea_id',$id)->sum('importe');
        $tarea->monto_ejecutado = $monto;
        $tarea->save();
    }

}
