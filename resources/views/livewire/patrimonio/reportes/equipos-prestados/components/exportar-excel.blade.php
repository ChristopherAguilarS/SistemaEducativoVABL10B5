<div>
    <table>
        <tr>
            <th colspan="17" style="text-align:center"><b>DETALLE DE AMBIENTES</b></th>
        </tr>
        <tr>
            <th colspan="2"><b>ENTIDAD</b></th>
            <th colspan="2"><b>: DIRECCIÓN REGIONAL DE EDUCACIÓN</b></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align:right"><b>AÑO:</b></th>
            <th style="text-align:center"><b>{{date('Y')}}</b></th>
        </tr>
        <tr>
            <th colspan="2"><b>DEPENDENCIA</b></th>
            <th colspan="4"><b>: INSTITUTO SUPERIOR PEDAGÓGICO PÚBLICO " VÍCTOR ANDRÉS BELAUNDE" - JAÉN</b></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align:right"><b>FECHA:</b></th>
            <th style="text-align:center"><b>{{date('d/m/Y h:i a')}}</b></th>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th>Cód</th>
                <th>QR</th>
                <th style="width:200px">Equipo/Bien</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Color</th>
                <th>Trabajador</th>
                <th>Ambiente</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $documento)
                <tr>
                    <td class="font-medium" style="vertical-align:middle">
                        {{ $documento->CODIGO_ACTIVO ? $documento->CODIGO_ACTIVO : 'E' . str_pad($documento->Id, 11, "0", STR_PAD_LEFT) }}
                    </td>
                    <td style="vertical-align:middle">
                        {{$documento->id}}
                    </td>
                    <td style="vertical-align:middle">
                        {{ ucwords(strtolower($documento->DESCRIPCION)) }}
                    </td>
                    <td style="vertical-align:middle">
                        {{ ucwords(strtolower($documento->MODELO)) }}
                    </td>
                    <td style="vertical-align:middle">
                        {{ ucwords(strtolower($documento->NRO_SERIE)) }}
                    </td>
                    <td style="vertical-align:middle">
                        {{ ucwords(strtolower($documento->COLOR)) }}
                    </td>
                    <td style="vertical-align:middle">
                        {{ $documento->trabajador ? $documento->trabajador : 'No Asignado' }}
                    </td>
                    <td style="vertical-align:middle">
                        {{ $documento->ambiente }}
                    </td>
                    <td style="vertical-align:middle; text-align:center">
                        <?php 
                            if ($documento->ESTADO_CONSERV == 1) {
                                echo "Bueno";
                            } elseif ($documento->ESTADO_CONSERV == 2) {
                                echo "Regular";
                            } elseif ($documento->ESTADO_CONSERV == 3) {
                                echo "Malo";
                            } elseif ($documento->ESTADO_CONSERV == 4) {
                                echo "Muy Malo";
                            } elseif ($documento->ESTADO_CONSERV == 5) {
                                echo "Nuevo";
                            } elseif ($documento->ESTADO_CONSERV == 6) {
                                echo "Chatarra";
                            } elseif ($documento->ESTADO_CONSERV == 7) {
                                echo "RAEE";
                            }
                        ?>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>