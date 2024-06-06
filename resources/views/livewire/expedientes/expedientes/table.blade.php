
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
                                    <th style="width:5px">Archivo</th>
                                    <th style="width:5px">Estado</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <tr>
                                        <td>{{$data->id}}</td>
                                            <td style="vertical-align:middle">{{date('d/m/Y', strtotime($data->created_at))}}</td>
                                            <td style="vertical-align:middle">{{date('h:i a', strtotime($data->created_at))}}</td>
                                            <td style="vertical-align:middle">{{$data->remitente_nombre}}</td>
                                            <td style="vertical-align:middle">{{$data->asunto}}</td>
                                            <td style="vertical-align:middle; text-align:Center">
                                                <a href="/pdf/expedientes/{{$data->id.'.pdf'}}" target="_blank" type="button" class="btn btn-outline-success btn-icon waves-effect waves-light material-shadow-none">
                                                    <i class="bx bxs-file-pdf" style="font-size:30px"></i>
                                                </a>
                                            </td>
                                            <td style="vertical-align:middle">
                                                @if($data->estado == 0)
                                                    <h4><div class="badge bg-danger">Pendiente</div></h4>
                                                @elseif($data->estado == 1)
                                                    <h4><div class="badge bg-success">Atendido</div></h4>
                                                @elseif($data->estado == 2)
                                                    <h4><div class="badge bg-warning">Derivado</div></h4>
                                                @elseif($data->estado == 3)
                                                    <h4><div class="badge bg-dark">Denegado</div></h4>
                                                @endif
                                            </td>
                                            <td style="vertical-align:middle">
                                                <div class="btn-group material-shadow">
                                                    <button class="btn btn-info btn-sm dropdown-toggle material-shadow-none show" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        ...
                                                    </button>
                                                    <div class="dropdown-menu">
                                                    <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, 0])"><i class="ri-mail-check-line"></i> Ver</a>
                                                        <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, 1])"><i class="ri-mail-check-line"></i> Atender</a>
                                                        <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, 2])"><i class="ri-mail-send-line"></i> Derivar</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, 3])"><i class="ri-mail-close-line"></i> Denegar</a>
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
