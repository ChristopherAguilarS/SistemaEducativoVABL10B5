
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 10px;">Nro.</th>
                                    <th>Nombre</th>
                                    <th style="width:5px">Inicio</th>
                                    <th style="width:5px">Fin</th>
                                    <th style="width:5px">Estado</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->descripcion}}</td>
                                        <td>{{date('h:i a', strtotime($data->horaInicio))}}</td>
                                        <td>{{date('h:i a', strtotime($data->horaFin))}}</td>
                                        <td>
                                            <?php 
                                                if($data->estado == 1){
                                                    $text = 'Activo';
                                                    $tp='success';
                                                }else{
                                                    $text = 'Inactivo';
                                                    $tp='danger';
                                                } 
                                            ?>
                                            <div class="text-xs badge bg-{{$tp}} text-white">{{$text}}</div>
                                        </td>
                                        <td>
                                            <div class="btn-group material-shadow">
                                                <button class="btn btn-primary btn-sm dropdown-toggle material-shadow-none show" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    ...
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, 2])">Ver</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, 3])">Editar</a>
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('eliminar', [{{$data->id}}])">Eliminar</a>
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