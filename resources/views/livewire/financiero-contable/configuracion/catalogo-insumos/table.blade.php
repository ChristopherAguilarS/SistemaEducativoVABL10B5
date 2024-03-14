<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width:5px" scope="col">Cód</th>
                                    <th scope="col">Nombrec</th>
                                    <th style="width:5px" scope="col">U.M.</th>
                                    <th style="width:5px" class="text-center" scope="col">Estado</th>
                                    <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    <?php
                                        $meses = ['', 'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SETIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                                    ?>
                                    @foreach ($posts as $data)
                                        <tr>                
                                            <td class="font-medium align-middle">
                                                HMI-{{str_pad($data->id, 6, "0", STR_PAD_LEFT)}}
                                            </td>
                                            <td class="align-middle">
                                                {{$data->insumo}}
                                            </td>
                                            <td class="align-middle">
                                                {{$data->medida}} 
                                            </td>
                                            <td class="align-middle text-center">
                                                @if($data->estado == 1)
                                                    <span style="margin-top:5px" class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </td>
                                                                               
                                            <td class="text-center align-middle"> 
                                                <button type="button" @click="$dispatch('nuevo', [{{ $data->id }}])" class="btn btn-info btn-sm"><i class="ri-contacts-book-line"></i> Ver</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"><center>Sin Información</center></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
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
</div>
