<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SubGenericas 2</h4>
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
                                <th scope="col">Sub Generica 1</th>
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

<div>
    <div class="box">
        <div class="box-header">
            <h5 class="box-title">SubGenericas</h5>
        </div>
        <div class="box-body p-0">
            <div class="overflow-auto">
                <table class="ti-custom-table ti-custom-table-head ti-striped-table">
                    <thead>
                        <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">SubGenerica 1</th>
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
                                    {{ optional(optional($subgenerica)->subgenericanivel1)->descripcion }}
                                </td>
                                <td>
                                    @if($subgenerica->estado == 1)
                                        <span class="badge bg-green-500 text-white">{{ $subgenerica->nEstado }}</span>
                                    @else
                                        <span class="badge bg-red-500 text-white">{{ $subgenerica->nEstado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="ti-btn rounded-full ti-btn-outline ti-btn-outline-danger">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-1 px-4 mt-5">
                {{ $subgenericas->links() }}
            </div>
        </div>
    </div>
</div>
