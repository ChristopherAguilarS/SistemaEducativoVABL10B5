<table>
    <tr>
        <td style="font-size: 18px; text-align: center; padding: 20px; margin: 30px; height: 80px; vertical-align: middle" colspan="17">
            <strong style="text-decoration: underline; text-transform: uppercase;"> <u>RESUMEN DE EJECUCION</u> </strong>
        </td>
    </tr>
    <tr>

    </tr>
    @foreach ($objetivos as $objetivo)
        <tr>
            <th style="border: 1px solid #999; background: lightblue"><b>Objetivo</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Monto Asignado</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Actividad</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Monto Asignado</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Indicador</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Monto Asignado</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Ejecución de gasto</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Comprobante</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Descripcion</b></th>            
            <th style="border: 1px solid #999; background: lightblue"><b>Fecha</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Monto</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Responsable</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Clasificador</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Descripcion Clasificador</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Ejecucion</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>% Avance</b></th>
            <th style="border: 1px solid #999; background: lightblue"><b>Saldo</b></th>
        </tr>
        @php
            $firstObjetivo = true;
        @endphp
        @foreach ($objetivo->acciones_estrategicas_priorizadas as $accion)
            @php
                $sumObjetivo = 0;
                foreach($objetivo->acciones_estrategicas_priorizadas as $acc){
                    foreach ($acc->actividades_operativas as $act) {
                        $sumObjetivo = $sumObjetivo + $act->indicadores->count();
                    }
                }
                $firstAccion = true;
            @endphp
            @foreach ($accion->actividades_operativas as $actividad)
                @php
                    $firstActividad = true;
                @endphp
                @foreach ($actividad->indicadores as $indicador)
                    @php                        
                        $firstIndicador = true;
                        $totalMontoTareas = $indicador->tareas_ejecutadas->sum('importe');
                    @endphp
                    @foreach ($indicador->tareas_ejecutadas as $tarea)
                        <tr>
                            <!-- Objetivo -->
                            
                                @if($firstObjetivo)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $objetivo->contar_tareas_ejecutas() }}">
                                    OE. {{ $objetivo->codigo }}
                                </td>
                                @endif
                            
                            
                                @if($firstObjetivo)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $objetivo->contar_tareas_ejecutas() }}">
                                    {{ $objetivo->monto_asignado }}
                                    @php
                                        $firstObjetivo = false;
                                    @endphp
                                </td>
                                @endif
                            
                            <!-- Actividad -->                            
                                @if($firstAccion)
                                    <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $actividad->contar_tareas_ejecutas() }}">
                                    A. {{ $objetivo->codigo }}.{{ $accion->codigo }}.{{ $actividad->codigo }}
                                    </td>
                                @endif
                           
                            
                                @if($firstAccion)
                                    <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $actividad->contar_tareas_ejecutas() }}">
                                    {{ $actividad->monto_asignado }}
                                    @php
                                        $firstAccion = false;
                                    @endphp
                                    </td>
                                @endif
                            
                            <!-- Indicador -->
                            
                                @if($firstIndicador)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $indicador->tareas_ejecutadas->count() }}">        
                                        I. {{ $objetivo->codigo }}.{{ $accion->codigo }}.{{ $actividad->codigo }}. {{ $indicador->codigo }}
                                        @php
                                            $firstIndicador = false;
                                        @endphp
                                </td> 
                                @endif
                            
                            
                                        
                                @if($loop->first)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $indicador->tareas_ejecutadas->count() }}">
                                    {{ $indicador->monto_asignado }}
                                </td>  
                                @endif
                            
                            <!-- Tarea -->
                            <td style="border: 1px solid black;">
                                EG. {{ $objetivo->codigo }}.{{ $accion->codigo }}.{{ $actividad->codigo }}. {{ $indicador->codigo }}.{{ $loop->index + 1 }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ $tarea->comprobante }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ $tarea->descripcion }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ \Carbon\Carbon::parse($tarea->fecha_emision_documento)->format('d/m/Y') }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ Illuminate\Support\Number::currency($tarea->importe, in: 'S/.', locale: 'en') }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ $tarea->responsable->descripcion }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ $tarea->especificanivel2->codigo }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ $tarea->especificanivel2->descripcion }}
                            </td>                            
                            
                                @if($loop->first)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $indicador->tareas_ejecutadas->count() }}">
                                    {{ Illuminate\Support\Number::currency($totalMontoTareas, in: 'S/.', locale: 'en') }}
                                </td>
                                @endif
                            
                            
                                @if($loop->first)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $indicador->tareas_ejecutadas->count() }}">
                                {{ round($totalMontoTareas / $indicador->monto_asignado * 100,2) }} %
                            </td>
                                @endif
                            
                            
                                @if($loop->first)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $indicador->tareas_ejecutadas->count() }}">
                                {{ Illuminate\Support\Number::currency($indicador->monto_asignado - $totalMontoTareas, in: 'S/.', locale: 'en') }}
                            </td>
                                @endif
                            
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        <tr></tr>
    @endforeach
</table>
