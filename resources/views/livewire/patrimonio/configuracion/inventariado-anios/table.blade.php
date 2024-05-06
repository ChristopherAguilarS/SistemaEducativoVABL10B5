
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 10px;">Nro.</th>
                                    <th>Año</th>
                                    <th style="width:5px">Estado</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->anio}}</td>
                                        <td>
                                            @if($data->estado)
                                                <h4><div class="badge bg-success">Activo</div></h4>
                                            @else
                                                <h4><div class="badge bg-danger">Inactivo</div></h4>
                                            @endif
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
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('delAnio', [{{$data->anio}}])">Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
