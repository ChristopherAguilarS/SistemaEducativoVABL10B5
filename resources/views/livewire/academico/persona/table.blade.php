<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Personas</h4>
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
                                <th scope="col">Nombre</th>
                                <th scope="col">Tipo Documento</th>
                                <th scope="col">N° Documento</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($personas as $persona)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $persona->n_nombre_completo }}
                                        </td>
                                        <td>
                                            {{ $persona->n_tipo_documento }}
                                        </td>
                                        <td>
                                            {{ $persona->nro_documento }}
                                        </td>
                                        <td>
                                            {{ $persona->genero }}
                                        </td>
                                        <td>
                                            @if($persona->estado == 1)
                                                <span class="badge bg-success">{{ $persona->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $persona->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($persona->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $persona->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $persona->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $persona->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $personas->links() }}
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
                            <label for="nombres" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombres" wire:model='form.nombres'>
                            <div>
                                @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ape_pat" class="col-form-label">Ap. Paterno:</label>
                            <input type="text" class="form-control" id="ape_pat" wire:model='form.ape_pat'>
                            <div>
                                @error('form.ape_pat') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ape_mat" class="col-form-label">Ap. Materno:</label>
                            <input type="text" class="form-control" id="ape_mat" wire:model='form.ape_mat'>
                            <div>
                                @error('form.ape_mat') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_documento" class="col-form-label">Tipo de Documento:</label>
                            <select class="form-control" id="tipo_documento" name="state" wire:model='form.tipo_documento'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="dni">DNI</option> 
                                <option value="carnet_extranjeria">Carnet de Extranjeria</option> 
                                <option value="pasaporte">Pasaporte</option> 
                            </select>
                            @error('form.tipo_documento') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nro_documento" class="col-form-label">N° Documento:</label>
                            <input type="text" class="form-control" id="nro_documento" wire:model='form.nro_documento'>
                            <div>
                                @error('form.nro_documento') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="genero" class="col-form-label">Genero:</label>
                            <select class="form-control" id="genero" name="genero" wire:model='form.genero'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="0">Masculino</option> 
                                <option value="1">Femenino</option> 
                            </select>
                            @error('form.genero') <span class="error">{{ $message }}</span> @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="telefono" class="col-form-label">Telefono:</label>
                            <input type="text" class="form-control" id="telefono" wire:model='form.telefono'>
                            <div>
                                @error('form.telefono') <span class="error">{{ $message }}</span> @enderror
                            </div>
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
        </script>
    @endscript
</div>
