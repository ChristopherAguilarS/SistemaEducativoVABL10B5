<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width:5px" scope="col">N°</th>
                                    <th rowspan="2" scope="col">Nombre</th>
                                    <th rowspan="2" style="width:5px" scope="col" class="text-center"></th>
                                    <th colspan="2" scope="col"><center>(.pdf)</center></th>
                                </tr>
                                <tr>
                                    <th style="width:5px" scope="col" class="text-center"></th>
                                    <th style="width:5px" scope="col" class="text-center"></th>
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
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm"  @click="$dispatch('nuevo', [{{ $especifica->id }}])"><i class="ri-edit-2-line"></i> Cursos</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm"  @click="$dispatch('nuevo', [{{ $especifica->id }}])"><i class="bx bx-cloud-upload" style="font-size:16px"></i> Silabo</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm"  @click="$dispatch('nuevo', [{{ $especifica->id }}])"><i class="bx bx-cloud-upload" style="font-size:16px"></i> Malla C.</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm"  @click="$dispatch('nuevo', [{{ $especifica->id }}])"><i class="ri-edit-2-line"></i</button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm"  @click="$dispatch('eliminar', [{{ $especifica->id }}])"><i class="ri-delete-bin-line"></i></button>
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
