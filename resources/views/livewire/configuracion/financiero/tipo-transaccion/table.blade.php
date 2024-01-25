<div>
    <div class="box">
        <div class="box-header">
            <h5 class="box-title">Tipos de Transacciones</h5>
        </div>
        <div class="p-0 box-body">
            <div class="overflow-auto">
                <table class="ti-custom-table ti-custom-table-head ti-striped-table">
                    <thead>
                        <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="!text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipoTransacciones as $tipoTransaccion)
                            <tr>                
                                <td class="font-medium">
                                    {{ $loop->index+1 }}
                                </td>
                                <td>
                                    {{ $tipoTransaccion->descripcion }}
                                </td>
                                <td>
                                    @if($tipoTransaccion->estado == 1)
                                        <span class="text-white bg-green-500 badge">{{ $tipoTransaccion->nEstado }}</span>
                                    @else
                                        <span class="text-white bg-red-500 badge">{{ $tipoTransaccion->nEstado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="rounded-full ti-btn ti-btn-outline ti-btn-outline-danger">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-1 mt-5">
                {{ $tipoTransacciones->links() }}
            </div>
        </div>
    </div>
</div>
