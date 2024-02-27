<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Ciclos</h4>
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
                                <th scope="col">Año Academico</th>
                                <th scope="col">Tipo de Ciclo</th>
                                <th scope="col">Fec. Inicio</th>
                                <th scope="col">Fec. Fin</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ciclos as $ciclo)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $ciclo->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional(optional($ciclo)->año_academico)->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional(optional($ciclo)->tipo_ciclo)->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional($ciclo)->fecha_inicio }}
                                        </td>
                                        <td>
                                            {{ optional($ciclo)->fecha_fin }}
                                        </td>
                                        <td>
                                            @if($ciclo->estado == 1)
                                                <span class="badge bg-success">{{ $ciclo->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $ciclo->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($ciclo->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $ciclo->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $ciclo->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $ciclo->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $ciclos->links() }}
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
                            <label for="descripcion" class="col-form-label">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" wire:model='form.descripcion'>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="tipo_ciclo_id" class="col-form-label">Tipo de Ciclo:</label>
                            <select class="js-example-basic-single" id="tipo_ciclo_id" name="state" wire:model='form.tipo_ciclo_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($tipo_ciclos as $tipo_ciclo)
                                    <option value="{{ $tipo_ciclo->id }}">{{ $tipo_ciclo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.tipo_ciclo_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="año_academico_id" class="col-form-label">Año academico:</label>
                            <select class="js-example-basic-single" id="año_academico_id" name="state" wire:model='form.año_academico_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($año_academicos as $año_academico)
                                    <option value="{{ $año_academico->id }}">{{ $año_academico->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.año_academico_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="col-form-label">Fecha Inicio:</label>
                            <input type="date" class="form-control" wire:model='form.fecha_inicio'>
                            <div>
                                @error('form.fecha_inicio') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="col-form-label">Fecha Fin:</label>
                            <input type="date" class="form-control" wire:model='form.fecha_fin'>
                            <div>
                                @error('form.fecha_fin') <span class="error">{{ $message }}</span> @enderror
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
            $('#tipo_ciclo_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#tipo_ciclo_id').on('change',function(){
                let a = document.getElementById("tipo_ciclo_id").value;
                $wire.set('form.tipo_ciclo_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#tipo_ciclo_id').val(event.id);
                $('#tipo_ciclo_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#tipo_ciclo_id').val(null).trigger('change');
            });
            $('#año_academico_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#año_academico_id').on('change',function(){
                let a = document.getElementById("año_academico_id").value;
                $wire.set('form.año_academico_id',a);
            })
            $wire.on('cambiarSeleccionAño', (event) => {
                $('#año_academico_id').val(event.id);
                $('#año_academico_id').trigger('change');
            });
            $wire.on('anularSeleccionAño', (event) => {
                $('#año_academico_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>
