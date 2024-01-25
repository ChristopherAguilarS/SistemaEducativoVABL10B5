<div>
    <div class="box">
        <div class="box-header">
            <h5 class="box-title">Genericas</h5>
        </div>
        <div class="box-body p-0">
            <div class="overflow-auto">
                <table class="ti-custom-table ti-custom-table-head ti-striped-table">
                    <thead>
                        <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Tipo Transaccion</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="!text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genericas as $generica)
                            <tr>                
                                <td class="font-medium">
                                    {{ $loop->index+1 }}
                                </td>
                                <td>
                                    {{ $generica->descripcion }}
                                </td>
                                <td>
                                    {{ optional(optional($generica)->tipo_transaccion)->descripcion }}
                                </td>
                                <td>
                                    @if($generica->estado == 1)
                                        <span class="badge bg-green-500 text-white">{{ $generica->nEstado }}</span>
                                    @else
                                        <span class="badge bg-red-500 text-white">{{ $generica->nEstado }}</span>
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
                {{ $genericas->links() }}
            </div>
        </div>
    </div>
</div>
