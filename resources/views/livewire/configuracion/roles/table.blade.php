
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" wire:loading.class="opacity-50">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width: 10px;">Cód.</th>
                                    <th>Nombre del Rol</th>
                                    <th>Modulo</th>
                                    <th style="width:5px">Estado</th>
                                    <th style="width:5px">Menus</th>
                                    <th rowspan="2" style="width: 10px;">Acc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->rol}}</td>
                                            <td>{{$data->modulo}}</td>
                                            <td>
                                                @if($data->estado)
                                                    <h4><div class="badge bg-success">Activo</div></h4>
                                                @else
                                                    <h4><div class="badge bg-danger">Inactivo</div></h4>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" @click="$dispatch('nuevoMenu', [{{$data->id}}])" class="btn btn-info btn-sm"><i class="ri-contacts-book-line"></i> Menus</button>
                                            </td>
                                            <td style="text-align:Center" class="gridjs-td">
                                                <span>
                                                    <div class="dropdown">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end" style="">
                                                            <li>
                                                                <a class="dropdown-item" wire:click="$dispatch('nuevo', [{{$data->id}}, 2])">
                                                                    <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Ver
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item edit-list" wire:click="$dispatch('nuevo', [{{$data->id}}, 3])">
                                                                    <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item remove-list" wire:click="$dispatch('delCat', [{{$data->id}}])">
                                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </span>
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
