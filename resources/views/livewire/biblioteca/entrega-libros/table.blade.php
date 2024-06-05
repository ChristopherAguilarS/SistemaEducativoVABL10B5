
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
                                    <th style="width:5px">Entrega</th>
                                    <th style="width:5px">Recepción</th>
                                    <th style="width:5px">Estado</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <?php 
                                            if($data->imagen){
                                                $rImagen = $data->idi.'.'.$data->imagen;
                                            }else{
                                                $rImagen = 'sin_foto.jpeg';
                                            }
                                            
                                        ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><b>{{str_pad($data->id, 6, "0", STR_PAD_LEFT)}}</b></td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <div class="bg-light rounded p-1" style="    width: 3rem;">
                                                                <img src="/images/libros/{{$rImagen}}" alt="" class="img-fluid d-block">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="flex-grow-1">
                                                            <h5 class="fs-14 mb-1">
                                                                <a href="apps-ecommerce-product-details.html" class="text-body">{{$data->nombre}}</a>
                                                            </h5>
                                                            <p class="text-muted mb-0">Autor : <span class="fw-medium">{{$data->autor}}</span></p>
                                                        </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <span>
                                                    <span class="badge bg-light text-body fs-12 fw-medium">
                                                        <i class="mdi mdi-star text-warning me-1"></i>{{$data->valoracion?$data->valoracion:'0'}}
                                                    </span>
                                                </span>
                                            </td>
                                            <td style="vertical-align: middle;">{{$data->usuario}}</td>
                                            <td style="vertical-align: middle;">{{date('d/m/Y', strtotime($data->solicitado))}} <br><small class="text-muted ms-1">{{date('h:i a', strtotime($data->solicitado))}}</small></td>
                                            <td style="vertical-align: middle;">
                                                @if($data->estado == 2 || $data->estado == 3)
                                                    {{date('d/m/Y', strtotime($data->recojo_at))}} <br><small class="text-muted ms-1">{{date('h:i a', strtotime($data->recojo_at))}}</small>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if($data->estado == 3)
                                                    {{date('d/m/Y', strtotime($data->entrega_at))}} <br><small class="text-muted ms-1">{{date('h:i a', strtotime($data->entrega_at))}}</small>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle; text-align:center">
                                                @if($data->estado == 1)
                                                    <h4><div class="badge bg-warning">Reservado</div></h4>
                                                @elseif($data->estado == 2)
                                                    <h4><div class="badge bg-success">Entregado</div></h4>
                                                @elseif($data->estado == 3)
                                                    <h4><div class="badge bg-info">Recepción</div></h4>
                                                @elseif($data->estado == 0)
                                                    <h4><div class="badge bg-danger">Cancelado</div></h4>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;">
                                    
                                                <div class="dropdown">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item cursor-pointer" wire:click="$dispatch('nuevo', [{{$data->id}}, 2])">
                                                                <i class="mdi mdi-microsoft-xbox-controller-view" style="font-size:20px"></i> <b>VER</b>
                                                            </a>
                                                        </li>
                                                        @if($data->estado == 1)
                                                        <li>
                                                            <a class="dropdown-item cursor-pointer" wire:click="$dispatch('entrega', [{{$data->id}}])">
                                                                <i class="mdi mdi-file-upload-outline" style="font-size:20px"></i> <b>ENTREGA</b>
                                                            </a>
                                                        </li>
                                                        @elseif($data->estado == 2)
                                                        <li>
                                                            <a class="dropdown-item cursor-pointer" wire:click="$dispatch('recepcion', [{{$data->id}}])">
                                                            <i class="mdi mdi-file-download-outline" style="font-size:20px"></i> <b>RECEPCION</b>
                                                            </a>
                                                        </li>
                                                        @endif
                                                        @if($data->estado == 1)
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item remove-list cursor-pointer" wire:click="$dispatch('delCat', [{{$data->id}}])">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Cancelar
                                                            </a>
                                                        </li>
                                                        @endif
                                                    </ul>
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
