
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">Cód.</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Ubicacion</th>
                                    <th style="width: 10px;">Estado</th>
                                    <th style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->nombre}}</td>
                                            <td>{{$data->tipo}}</td>
                                            <td>{{$data->ubicacion}}</td>
                                            <td>
                                                @if($data->estado)
                                                    <h4><span class="badge bg-success">Activo</span></h4>
                                                @else
                                                    <h4><span class="badge bg-danger">Inactivo</span></h4>
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
                                                        <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('delAmb', [{{$data->id}}])">Eliminar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7"><center><i><b>Sin Información</b></i></center></td>
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
