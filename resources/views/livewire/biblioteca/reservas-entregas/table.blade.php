
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" wire:loading.class="opacity-50">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 10px;">Código</th>
                                    <th>Libro</th>
                                    <th>Valoracion</th>
                                    <th>Usuario</th>
                                    <th style="width:5px">Solicitado</th>
                                    <th style="width:5px">Entregado</th>
                                    <th style="width:5px">Estado</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <?php 
                                            if($data->imagen){
                                                $rImagen = $data->id.'.'.$data->imagen;
                                            }else{
                                                $rImagen = 'sin_foto.jpeg';
                                            }
                                            
                                        ?>
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>
                                                <span>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded p-1">
                                                                <img src="/images/libros/{{$rImagen}}" alt="" class="img-fluid d-block">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h5 class="fs-14 mb-1">
                                                                <a href="apps-ecommerce-product-details.html" class="text-body">{{$data->nombre}}</a>
                                                            </h5>
                                                            <p class="text-muted mb-0">Autor : <span class="fw-medium"></span></p>
                                                        </div>
                                                    </div>
                                                </span>
                                            </td>
                                            <td>
                                                <span>
                                                    <span class="badge bg-light text-body fs-12 fw-medium">
                                                        <i class="mdi mdi-star text-warning me-1"></i>4.2
                                                    </span>
                                                </span>
                                            </td>
                                            <td>{{$data->usuario}}</td>
                                            <td>{{date('d/m/Y', strtotime($data->solicitado))}} <br><small class="text-muted ms-1">{{date('h:i a', strtotime($data->solicitado))}}</small></td>
                                            <td>
                                                @if($data->estado == 3)
                                                    {{date('d/m/Y', strtotime($data->devuelto))}} <br><small class="text-muted ms-1">{{date('h:i a', strtotime($data->devuelto))}}</small>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($data->estado == 1)
                                                    <h4><div class="badge bg-warning">Reservado</div></h4>
                                                @elseif($data->estado == 2)
                                                    <h4><div class="badge bg-success">Entregado</div></h4>
                                                @elseif($data->estado == 3)
                                                    <h4><div class="badge bg-info">Devuelto</div></h4>
                                                @elseif($data->estado == 4)
                                                    <h4><div class="badge bg-danger">Cancelado</div></h4>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group material-shadow">
                                                    <button class="btn btn-primary btn-sm dropdown-toggle material-shadow-none show" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        ...
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('nuevo', [{{$data->id}}, 2])"><i class="mdi mdi-microsoft-xbox-controller-view" style="font-size:20px"></i> <b>VER</b></a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item cursor-pointer"  wire:click="$dispatch('delCat', [{{$data->id}}])"><i class="mdi mdi-elevator-passenger-off-outline" style="font-size:20px"></i><b> CANCELAR</b></a>
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
