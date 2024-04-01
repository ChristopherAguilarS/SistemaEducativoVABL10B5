<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width:5px" scope="col">N°</th>
                                    <th scope="col">Nombre</th>
                                    <th style="width:5px" scope="col">Estado</th>
                                    <th style="width:5px" scope="col" class="text-center"></th>
                                    <th style="width:5px" scope="col" class="text-center"></th>
                                    <th style="width:5px" scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especificas as $especifica)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->iteration}}
                                        </td>
                                        <td>
                                            {{ $especifica->nombre }}
                                        </td>
                                        <td>
                                            <h5>
                                                @if($especifica->estado == 1)
                                                    <span style="margin-top:5px" class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-danger">Inactivo</span>
                                                @endif
                                            </h5>
                                            
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-sm"  @click="$dispatch('nuevo', [{{ $especifica->id }}])"><i class="ri-edit-2-line"></i> Cursos</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm"  @click="$dispatch('nuevo', [{{ $especifica->id }}])"><i class="ri-edit-2-line"></i> Editar</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm"  @click="$dispatch('eliminar', [{{ $especifica->id }}])"><i class="ri-delete-bin-line"></i> Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $especificas->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</div>
