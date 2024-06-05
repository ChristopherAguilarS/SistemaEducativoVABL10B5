
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" wire:loading.class="opacity-50">
                    <table class="gridjs-table">
                        <thead class="gridjs-thead">
                            <tr class="gridjs-tr">
                                <th class="gridjs-th gridjs-th-sort text-muted" style="width: 4px; text-align:center"><div class="gridjs-th-content">Código</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="text-align:center"><div class="gridjs-th-content">Libro</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="width: 120px; text-align:center"><div class="gridjs-th-content">Editorial</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="width: 120px; text-align:center"><div class="gridjs-th-content">Publicacion</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="width: 5px; text-align:center"><div class="gridjs-th-content">Tipo</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="width: 120px; text-align:center"><div class="gridjs-th-content">Valoracion</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="width: 5px; text-align:center"><div class="gridjs-th-content">Creado</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="width: 120px; text-align:center"><div class="gridjs-th-content">Estado</div></th>
                                <th  class="gridjs-th gridjs-th-sort text-muted" style="width: 120px; text-align:center"><div class="gridjs-th-content">Acciones</div></th></tr>
                        </thead>
                        <tbody class="gridjs-tbody">
                            @if($posts->count()>0)
                                @foreach ($posts as $data)
                                    <?php 
                                        if($data->imagen){
                                            $rImagen = $data->id.'.'.$data->imagen;
                                        }else{
                                            $rImagen = 'sin_foto.jpeg';
                                        }
                                        
                                    ?>
                                    <tr class="gridjs-tr">
                                        <td class="gridjs-td">
                                            <span>
                                                <div class="form-check checkbox-product-list">					
                                                    {{str_pad($data->id, 10, "0", STR_PAD_LEFT)}}
                                                </div>
                                            </span>
                                        </td>
                                        <td  class="gridjs-td">
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
                                                            <p class="text-muted mb-0">Autor : <span class="fw-medium"></span></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td  class="gridjs-td">
                                            {{$data->editorial->descripcion}}
                                        </td>
                                        <td style="text-align:center" class="gridjs-td"><span>{{$data->anio}}</span></td>
                                        <td style="text-align:center" class="gridjs-td">{{$data->ingreso->descripcion}}</td>
                                        <td style="text-align:center" class="gridjs-td">
                                            <span>
                                                <span class="badge bg-light text-body fs-12 fw-medium">
                                                    <i class="mdi mdi-star text-warning me-1"></i>{{$data->valoracion?$data->valoracion:'0'}}
                                                </span>
                                            </span>
                                        </td>
                                        <td  class="gridjs-td">
                                            <span>{{date('d/m/Y', strtotime($data->ingreso->created_at))}}<small class="text-muted ms-1"><br>{{date('h:i a', strtotime($data->ingreso->created_at))}}</small></span>
                                        </td>
                                        <td style="text-align:center" class="gridjs-td">
                                            @if($data->estado == 1)
                                                <span class="badge bg-success text-white fs-12 fw-medium">Bueno</span>
                                            @elseif($data->estado == 2)
                                                <span class="badge bg-danger text-white fs-12 fw-medium">Dañado</span>
                                            @else
                                                <span class="badge bg-warning text-white fs-12 fw-medium">No Disponible</span>
                                            @endif
                                        </td>
                                        <td  style="text-align:Center" class="gridjs-td">
                                            <span>
                                                <div class="dropdown">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item" href="apps-ecommerce-product-details.html">
                                                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item edit-list" @click="$dispatch('nuevo', [{{$data->id}}, 3])">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#" data-id="1" data-bs-toggle="modal" data-bs-target="#removeItemModal">
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
