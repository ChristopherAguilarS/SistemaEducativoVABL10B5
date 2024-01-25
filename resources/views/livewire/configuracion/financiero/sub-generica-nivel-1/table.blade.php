<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SubGenericas</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Generica</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subgenericas as $subgenerica)
                            <tr>                
                                <td class="font-medium">
                                    {{ $loop->index+1 }}
                                </td>
                                <td>
                                    {{ $subgenerica->descripcion }}
                                </td>
                                <td>
                                    {{ optional(optional($subgenerica)->generica)->descripcion }}
                                </td>
                                <td>
                                    @if($subgenerica->estado == 1)
                                        <span class="badge bg-success">{{ $subgenerica->nEstado }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $subgenerica->nEstado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-animation waves-effect waves-light" data-text="Info"><span>Editar</span></button>
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $subgenericas->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</div>
