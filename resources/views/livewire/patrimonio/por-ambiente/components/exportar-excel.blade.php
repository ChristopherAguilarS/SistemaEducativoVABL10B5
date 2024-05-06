<div>
    <table>
        <tr>
            <th colspan="21" style="text-align:center"><b>INVENTARIO FISICO Y VALORIZADO DE BIENES MUEBLES</b></th>
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
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align:right"><b>AÑO:</b></th>
            <th style="text-align:center"><b>2020</b></th>
        </tr>
        <tr>
            <th colspan="2"><b>DEPENDENCIA</b></th>
            <th colspan="4"><b>: INSTITUTO SUPERIOR PEDAGÓGICO PÚBLICO " VÍCTOR ANDRÉS BELAUNDE" - JAÉN</b></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align:right"><b>FECHA:</b></th>
            <th style="text-align:center"><b>8/05/2017</b></th>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; height:30px; vertical-align:middle">Ítem</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; width:120px;">Código<br>Margesí<br>(1)</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; width:200px; vertical-align:middle">Tipo de Bien</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Nº Serie</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Marca</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Modelo</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">color</th>
                <th colspan="3" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Dimensiones</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Placa</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Nº<br>de<br>Motor</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Nº<br>de<br>Chasis</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Estado<br>del bien<br>(2)</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">En<br>Uso<br>(3)</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Fecha<br>Compra<br>(4)</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Valor<br>del Bien<br>(5)</th>
                <th colspan="3" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Ubicación Física</th>
                <th rowspan="2" style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Observaciones</th>
            </tr>
            <tr>
                <td style="background-color:#fce68a; border: 1px solid black; text-align:center; height:30px; vertical-align:middle">Ancho</td>
                <td style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Largo</td>
                <td style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Alto</td>
                <td style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Responsable</td>
                <td style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Área</td>
                <td style="background-color:#fce68a; border: 1px solid black; text-align:center; vertical-align:middle">Ambiente</td>
            </tr>
        </thead>
        <tbody>
            @foreach($ambientes as $ambiente)
                <tr>
                    <td colspan="5" style="border: 1px solid black; color:#1e88e5"><b>{{$loop->iteration.'. '.strtoupper($ambiente->nombre)}}</b></td>
                </tr>
                @foreach($posts->where('ambiente_id', $ambiente->id) as $equipo)
                    <tr>
                        <td style="border: 1px solid black;">{{$loop->iteration}}</td>
                        <td style="border: 1px solid black;">{{$equipo->CODIGO_ACTIVO}}</td>
                        <td style="border: 1px solid black;">{{$equipo->DESCRIPCION}}</td>
                        <td style="border: 1px solid black;">{{$equipo->NRO_SERIE}}</td>
                        <td style="border: 1px solid black;">{{$equipo->MARCA}}</td>
                        <td style="border: 1px solid black;">{{$equipo->MODELO}}</td>
                        <td style="border: 1px solid black;">{{$equipo->COLOR}}</td>
                        <td style="border: 1px solid black;">{{$equipo->ANCHO}}</td>
                        <td style="border: 1px solid black;">{{$equipo->LARGO}}</td>
                        <td style="border: 1px solid black;">{{$equipo->ALTO}}</td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;">
                            <?php 
                                if($equipo->ESTADO_CONSERV==1){
                                    ?><h4><span class="badge bg-info" style="color:white">Bueno</span></h4><?php
                                }elseif($equipo->ESTADO_CONSERV==2){
                                    ?><h4><span class="badge bg-primary">Regular</span></h4><?php
                                }elseif($equipo->ESTADO_CONSERV==3){
                                    ?><h4><span class="badge bg-warning">Malo</span></h4><?php
                                }elseif($equipo->ESTADO_CONSERV==4){
                                    ?><h4><span class="badge bg-danger">Muy Malo</span></h4><?php
                                }elseif($equipo->ESTADO_CONSERV==5){
                                    ?><h4><span class="badge bg-success">Nuevo</span></h4><?php
                                }elseif($equipo->ESTADO_CONSERV==6){
                                    ?><h4><span class="badge bg-secondary">Chatarra</span></h4><?php
                                }elseif($equipo->ESTADO_CONSERV==7){
                                    ?><h4><span class="badge bg-light">RAEE</span></h4><?php
                                }
                            ?>    
                        </td>
                        <td style="border: 1px solid black;">{{$equipo->EN_USO}}</td>
                        <td style="border: 1px solid black;">{{$equipo->FECHA_COMPRA}}</td>
                    </tr>
                @endforeach
            @endforeach
            
        </tbody>
    </table>
    <table>
        <tr>
            <td></td>
            <td style="color:#1e88e5"><b>LEYENDA</b></td>
        </tr>
        <tr>
            <td style="text-align:right">
                (1)
            </td>
            <td>
                Código Margesí: Este còdigo corresponde al del Catálogo de Bienes Nacionales se encuientra en Internet
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                (2)
            </td>
            <td>
                Estado: Estado del bien (<b>B</b>) Bueno, (<b>R</b>) Regular, (<b>M</b>) Malo
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                (3)
            </td>
            <td>
                En Uso: Cuando el bien esta operativo y siendo usado (<b>SI</b>), Cuando el bien ya no sirve o no está siendo usado (<b>NO</b>)
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                (4)
            </td>
            <td>
                Fecha de compra o adquisición: Consignar la fecha que fue adquirido el bien, la fecha de recibido en donación o en transferencia (si no se tuviera el dato exacto, consignar aproximadamente el año)
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                (5)
            </td>
            <td>
            Valor del bien: consignar el valor del bien adquirido, el valor del bien recibido en donación o en transferencia (si no se tuviera el dato exacto, consignar un valor aproximado)
            </td>
        </tr>
    </table>
</div>