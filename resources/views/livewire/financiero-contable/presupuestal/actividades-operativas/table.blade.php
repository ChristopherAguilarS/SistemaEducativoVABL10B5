<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Actividades Operativas</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>                                
                                <th scope="col">Acciones Estrategicas Priorizadas</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Saldo</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actividadOperativas as $actividadOperativa)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            AE.{{ $actividadOperativa->accion_estrategica_priorizada->objetivo_estrategico->codigo }}.{{ $actividadOperativa->accion_estrategica_priorizada->codigo }}.{{ $actividadOperativa->accion_estrategica_priorizada->descripcion }}
                                        </td>
                                        <td>
                                            A. {{ $actividadOperativa->accion_estrategica_priorizada->objetivo_estrategico->codigo }}.{{ $actividadOperativa->accion_estrategica_priorizada->codigo }}.{{ $actividadOperativa->codigo }}
                                        </td>
                                        <td>
                                            {{ $actividadOperativa->descripcion }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($actividadOperativa->monto_asignado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($actividadOperativa->saldo, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($actividadOperativa->estado == 1)
                                                <span class="badge bg-success">{{ $actividadOperativa->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $actividadOperativa->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 250px;">
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                @if($actividadOperativa->estado == 1)
                                                    <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $actividadOperativa->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-success bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $actividadOperativa->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $actividadOperativa->id }})'>Editar <i class="las la-edit"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $actividadOperativas->links() }}
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
                        {{-- <div class="mb-3">
                            <label for="codigo" class="col-form-label">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" wire:model='form.codigo'>
                            <div>
                                @error('form.codigo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripcion:</label>
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='form.descripcion'></textarea>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="accion_estrategica_priorizada_id" class="col-form-label">Acciones Estrategicas:</label>
                            <select class="js-example-basic-single" id="accion_estrategica_priorizada_id" name="state" wire:model='form.accion_estrategica_priorizada_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($acciones_estrategicas_priorizadas as $accion_estrategica)
                                    <option value="{{ $accion_estrategica->id }}">AE.{{ $accion_estrategica->objetivo_estrategico->codigo }}.{{ $accion_estrategica->codigo }} - {{ $accion_estrategica->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="monto" class="col-form-label">Monto:</label>
                            <input type="number" class="form-control" id="monto" wire:model='form.monto_asignado'>
                            <div>
                                @error('form.monto_asignado') <span class="error">{{ $message }}</span> @enderror
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
    @script()
        <script>
            $('#accion_estrategica_priorizada_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#accion_estrategica_priorizada_id').on('change',function(){
                let a = document.getElementById("accion_estrategica_priorizada_id").value;
                $wire.set('form.accion_estrategica_priorizada_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#accion_estrategica_priorizada_id').val(event.id);
                $('#accion_estrategica_priorizada_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#accion_estrategica_priorizada_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>

