
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" wire:loading.class="opacity-50">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 10px;">Cód.</th>
                                    <th>Nombre de Usuario</th>
                                    <th>Correo</th>
                                    <th style="width:5px">Estado</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
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
                                                        <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('delCat', [{{$data->id}}])">Eliminar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"><center><i><b>Sin Informacion Disponible</b></i></center></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
