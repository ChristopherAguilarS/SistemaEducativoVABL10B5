
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th
                                        rowspan="2"
                                        style="width: 10px;"
                                    >
                                        Nro.
                                    </th>
                                    <th
                                        rowspan="2"
                                        style="width:5px"
                                    >
                                        Tipo
                                    </th>
                                    <th
                                        rowspan="2"
                                    >
                                        Solicitante
                                    </th>
                                    <th
                                        style="width: 10px;"
                                        rowspan="2"
                                    >
                                        Fecha
                                    </th>
                                    <th
                                        rowspan="2"
                                    >
                                        Hora
                                    </th>
                                    <th
                                        style="width: 10px;"
                                        rowspan="2"
                                    >
                                        Revisión
                                    </th>
                                    <th
                                        class="text-center"
                                        colspan="3"
                                    >
                                        Items
                                    </th>
                                    <th
                                        rowspan="2"
                                        style="width: 10px;"
                                    >
                                        Acc
                                    </th>
                                </tr>
                                <tr>
                                    <th
                                        style="width: 10px;"
                                    >
                                        <i class="bx bx-hourglass text-warning" style="font-size:18px"></i>
                                    </th>
                                    <th
                                        style="width: 10px;"
                                    >
                                        <i class="bx bx-check text-success" style="font-size:18px"></i>
                                    </th>
                                    <th
                                        style="width: 10px;"
                                    >
                                        <i class="bx bx-no-entry text-danger" style="font-size:18px"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $data)
                                    <tr>
                                        <td>{{str_pad($data->correlativo, 6, "0", STR_PAD_LEFT)}}</td>
                                        <td>
                                            <?php
                                                if($data->tipo_id == 1){
                                                    echo 'COMPRA';
                                                }else{
                                                    echo 'TRASLADO';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            {{$data->nombre_completo }}
                                        </td>
                                        <td>
                                            {{date('d/m/Y', strtotime($data->created_at))}}
                                        </td>
                                        <td>
                                            {{date('h:i a', strtotime($data->created_at))}}
                                        </td>
                                        <td>
                                            <?php 
                                                if($data->pendientesCount()){
                                                    if($data->aprobadosCount()){
                                                        $text = 'Parcial';
                                                        $tp='warning';
                                                    }else{
                                                        $text = 'Pendiente';
                                                        $tp='danger';
                                                    }
                                                }else{
                                                    $text = 'Revisado';
                                                    $tp='success';
                                                } 
                                            ?>
                                            <div class="text-xs badge bg-{{$tp}} text-white">{{$text}}</div>
                                        </td>
                                        <td>
                                            <?php if($data->pendientes){$tp='danger';}else{$tp='success';} ?>
                                            <div class="text-xs badge rounded border border-warning text-warning">
                                                {{$data->pendientesCount()}}
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($data->aprobados){$tp='success';}else{$tp='danger';} ?>
                                            <div class="text-xs badge rounded border border-success text-success">
                                                {{$data->aprobadosCount()}}
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($data->pendientes){$tp='danger';}else{$tp='success';} ?>
                                            <div class="text-xs badge rounded border border-danger text-danger">
                                                {{$data->rechazadosCount()}}
                                            </div>
                                        </td>
                                        <td>
                                        <div class="btn-group material-shadow">
                                                <button class="btn btn-primary btn-sm dropdown-toggle material-shadow-none show" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    ...
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, {{$data->almacen_id}}, 2])">Ver</a>
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, {{$data->almacen_id}}, 3])">Revisar</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, {{$data->almacen_id}}, 4])">Editar</a>
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('eliminarPedido', [{{$data->id}}, {{$data->correlativo}}])">Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
