<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Estudiantes</h4>
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
                                <th scope="col">N° Estudiante</th>
                                <th scope="col">Estudiante</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $estudiante)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $estudiante->nro_estudiante }}
                                        </td>
                                        <td>
                                            {{ optional(optional($estudiante)->persona)->n_nombre_completo }}
                                        </td>
                                        <td>
                                            @if($estudiante->estado == 1)
                                                <span class="badge bg-success">{{ $estudiante->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $estudiante->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($estudiante->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $estudiante->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $estudiante->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $estudiante->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $estudiantes->links() }}
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
                            <label for="nro_estudiante" class="col-form-label">N° Estudiante:</label>
                            <input type="text" class="form-control" id="nro_estudiante" wire:model='form.nro_estudiante'>
                            <div>
                                @error('form.nro_estudiante') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3"  wire:ignore>
                            <label for="persona_id" class="col-form-label">Tipo Transaccion:</label>
                            <select class="js-example-basic-single" id="persona_id" name="state">
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id }}">{{ $persona->id }} - {{ $persona->n_nombre_completo }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.persona_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @script()
        <script>
            $('#persona_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#persona_id').on('change',function(){
                let a = document.getElementById("persona_id").value;
                $wire.set('form.persona_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#persona_id').val(event.id);
                $('#persona_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#persona_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>