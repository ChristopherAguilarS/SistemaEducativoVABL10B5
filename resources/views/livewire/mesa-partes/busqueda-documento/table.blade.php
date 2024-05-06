
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" wire:loading.class="opacity-50">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 10px;">Cód.</th>
                                    <th style="width: 10px;">Fecha</th>
                                    <th style="width: 100px;">Hora</th>
                                    <th>Remitente</th>
                                    <th>Asunto</th>
                                    <th style="width:5px">Estado</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <tr>
                                        <td>{{$data->id}}</td>
                                            <td>{{date('d/m/Y', strtotime($data->created_at))}}</td>
                                            <td>{{date('h:i a', strtotime($data->created_at))}}</td>
                                            <td>{{$data->remitente_nombre}}</td>
                                            <td>{{$data->asunto}}</td>
                                            <td>
                                                @if($data->estado == 0)
                                                    <h4><div class="badge bg-danger">Pendiente</div></h4>
                                                @elseif($data->estado == 1)
                                                    <h4><div class="badge bg-success">Atendido</div></h4>
                                                @elseif($data->estado == 2)
                                                    <h4><div class="badge bg-warning">En Tramite</div></h4>
                                                @elseif($data->estado == 3)
                                                    <h4><div class="badge bg-dark">Denegado</div></h4>
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
                                        <td colspan="7"><center><i><b>Sin Informacion Disponible</b></i></center></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
