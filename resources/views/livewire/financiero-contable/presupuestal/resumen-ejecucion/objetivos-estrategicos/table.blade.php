<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 400px">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Objetivos Estrategicos</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            @if($filaSeleccionada != null)
                            <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='limpiarSeleccion'>Limpiar Filtros <i class="ri-filter-off-fill align-bottom me-1"></i></button>
                            @endif
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Objetivo</th>
                                    <th scope="col">Monto Asignado</th>
                                    <th scope="col">Monto Ejecutado</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($objetivoEstrategicos as $objetivoEstrategico)
                                    <tr wire:click="seleccionarFila({{ $objetivoEstrategico->id }})"
                                        @if($filaSeleccionada == $objetivoEstrategico->id)
                                            class="table-active"
                                        @endif>                
                                        <td class="font-medium">{{ $loop->index+1 }}</td>
                                        <td class="font-medium">OE. {{ $objetivoEstrategico->codigo }}
                                            <button type="button" class="btn btn-primary rounded-pill bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalTooltip" wire:click='tooltip({{ $objetivoEstrategico->id }})'><i class="las la-search"></i></button></td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($objetivoEstrategico->monto_asignado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($objetivoEstrategico->monto_ejecutado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($objetivoEstrategico->saldo, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($objetivoEstrategico->monto_asignado > 0 && $objetivoEstrategico->monto_asignado != null)
                                                {{ number_format($objetivoEstrategico->monto_ejecutado/$objetivoEstrategico->monto_asignado, 2)*100 }} %
                                            @else
                                                0.00 %
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $objetivoEstrategicos->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!-- Default Modals -->
    <div wire:ignore.self id="myModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="codigo" class="col-form-label">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" wire:model='form.codigo'>
                            <div>
                                @error('form.codigo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripcion:</label>
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='form.descripcion'></textarea>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="monto" class="col-form-label">Monto Asignado:</label>
                            <input type="number" min="0" class="form-control" id="monto" wire:model='form.monto'>
                            <div>
                                @error('form.monto') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div wire:ignore.self id="modalTooltip" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    @if($objetivoSeleccionado != null)
                        <form>
                            <div class="mb-3">
                                <label class="col-form-label">Codigo:</label>
                                <label class="col-form-label">OE. {{ $objetivoSeleccionado->codigo }}</label>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <label class="col-form-label">{{ $objetivoSeleccionado->descripcion }}</label>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

