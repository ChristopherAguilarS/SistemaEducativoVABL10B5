
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width: 10px; vertical-align:middle;">Nro.</th>
                                    <th style="width: 10px; vertical-align:middle">Codigo</th>
                                    <th style="vertical-align:middle;">Denominación</th>
                                    <th style="vertical-align:middle;">Serie</th>
                                    <th style="vertical-align:middle;">Ubicacion</th>
                                    <th style="vertical-align:middle;">Observaciones</th>
                                    <th style="width: 10px;text-align:center">Fecha/Hora <br>Prestamo</th>
                                    <th style="width: 10px;vertical-align:middle;text-align:center">Estado</th>
                                    <th style="width: 10px;vertical-align:middle;">Prestamo/Devolucion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->CODIGO_ACTIVO}}</td>
                                            <td>{{$data->DESCRIPCION}}</td>
                                            <td>{{$data->NRO_SERIE}}</td>
                                            <td>
                                                <?php
                                                    if($data->prestado){
                                                        ?>{{$data->nombres}}<?php
                                                    }else{
                                                        ?>-<?php
                                                    }
                                                ?>
                                            </td>
                                            <td>{{$data->observaciones_entrega}}</td>
                                            <td style="text-align:center">
                                                @if($data->estado)
                                                    {{date('d/m/Y', strtotime($data->created_at))}}<br><small class="text-muted ms-1">{{date('h:i a', strtotime($data->created_at))}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="text-align:center">
                                                @if($data->prestado)
                                                    <h4><span class="badge bg-danger">Prestado</span></h4>
                                                @else
                                                    <h4><span style="margin-top:5px" class="badge bg-success">Disponible</span></h4>
                                                @endif
                                            </td>
                                            <td style="text-align:center">
                                                <button type="button" wire:click="$dispatch('Asignacion', [{{$data->equipo_id}}, '{{$data->CODIGO_ACTIVO}}', '{{$data->DESCRIPCION}}'])" class="btn btn-info"><i class="mdi mdi-account-convert-outline"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="7"><center><i><b>Sin Equipos Disponibles</b></i></center></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $posts->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
