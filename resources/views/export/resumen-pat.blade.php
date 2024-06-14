<table>
    <tr>
        <td style="font-size: 18px; text-align: center; padding: 20px; margin: 30px; height: 80px; vertical-align: middle" colspan="17">
            <strong style="text-decoration: underline; text-transform: uppercase;"> <u>RESUMEN DE EJECUCION DEL PLAN ANUAL DE TRABAJO</u> </strong>
        </td>
    </tr>
    <tr>

    </tr>
    <tr>
        <th style="border: 1px solid #999; background: lightblue"><b>Objetivo</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Monto Asignado</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Monto Gastado</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Saldo</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>% de Ejecución</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Actividad</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Monto Asignado</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Monto Gastado</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Saldo</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>% de Ejecución</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Indicador</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Monto Asignado</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Monto Gastado</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>Saldo</b></th>
        <th style="border: 1px solid #999; background: lightblue"><b>% de Ejecución</b></th>
    </tr>
    @foreach ($objetivos as $objetivo)
        
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
                        <tr>
                            <!-- Objetivo -->
                            @if($firstObjetivo)
                                <td style="border: 1px solid black;background: gainsboro;text-align: center;vertical-align: middle;" rowspan="{{ $objetivo->contar_indicadores() }}">
                                    OE. {{ $objetivo->codigo }} 
                                </td>    
                            @endif
                            
                            
                            @if($firstObjetivo)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $objetivo->contar_indicadores() }}">
                                    {{ Illuminate\Support\Number::currency($objetivo->monto_asignado, in: 'S/.', locale: 'en') }}
                                </td>
                            @endif

                            @if($firstObjetivo)
                            <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $objetivo->contar_indicadores() }}">
                                
                                    {{ Illuminate\Support\Number::currency($objetivo->monto_ejecutado, in: 'S/.', locale: 'en') }}
                                
                            </td>
                            @endif
                            
                                @if($firstObjetivo)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $objetivo->contar_indicadores() }}">
                                    {{ Illuminate\Support\Number::currency($objetivo->monto_asignado - $objetivo->monto_ejecutado, in: 'S/.', locale: 'en') }}
                                </td>
                            @endif
                            
                            
                                @if($firstObjetivo)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $objetivo->contar_indicadores() }}">
                                    {{ round($objetivo->monto_ejecutado/$objetivo->monto_asignado * 100,2) }}
                                    @php
                                        $firstObjetivo = false;
                                    @endphp
                                </td>
                                @endif
                            
                            <!-- Actividad -->
                            
                            @if($firstAccion)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;background: gainsboro" rowspan="{{ $actividad->indicadores->count() }}" >
                                    A. {{ $objetivo->codigo }}.{{ $accion->codigo }}.{{ $actividad->codigo }}
                                </td>
                            @endif
                            
                                @if($firstAccion)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $actividad->indicadores->count() }}">
                                    {{ Illuminate\Support\Number::currency($actividad->monto_asignado, in: 'S/.', locale: 'en') }}
                                </td>
                                    @endif
                            
                            
                                @if($firstAccion)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $actividad->indicadores->count() }}">
                                    {{ Illuminate\Support\Number::currency($actividad->monto_ejecutado, in: 'S/.', locale: 'en') }}
                                </td>
                                @endif
                            
                            
                            @if($firstAccion)
                                <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $actividad->indicadores->count() }}">
                                    {{ Illuminate\Support\Number::currency($actividad->monto_asignado - $actividad->monto_ejecutado, in: 'S/.', locale: 'en') }}
                                </td>
                            @endif
                            
                            
                            @if($firstAccion)
                             <td style="border: 1px solid black;text-align: center;vertical-align: middle;" rowspan="{{ $actividad->indicadores->count() }}">
                                    {{ round($actividad->monto_ejecutado / $actividad->monto_asignado * 100,2) }}
                                    @php
                                        $firstAccion = false;
                                    @endphp
                                    </td>
                            @endif
                            
                            <!-- Indicador -->
                            <td style="border: 1px solid black;text-align: center;vertical-align: middle;background: gainsboro" >
                                I. {{ $objetivo->codigo }}.{{ $accion->codigo }}.{{ $actividad->codigo }}. {{ $indicador->codigo }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ Illuminate\Support\Number::currency($indicador->monto_asignado, in: 'S/.', locale: 'en') }}
                                
                            </td>
                            <td style="border: 1px solid black;">
                                {{ Illuminate\Support\Number::currency($indicador->monto_ejecutado, in: 'S/.', locale: 'en') }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ Illuminate\Support\Number::currency($indicador->monto_asignado -$indicador->monto_ejecutado, in: 'S/.', locale: 'en') }}
                            </td>
                            <td style="border: 1px solid black;">
                                {{ round($indicador->monto_ejecutado / $indicador->monto_asignado * 100,2) }}
                            </td>
                        </tr>
                @endforeach
            @endforeach
        @endforeach
    @endforeach
</table>
