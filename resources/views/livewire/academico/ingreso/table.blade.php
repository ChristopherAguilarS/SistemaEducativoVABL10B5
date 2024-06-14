<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Otros Ingresos</h4>
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
                                <th scope="col">Estudiante</th>
                                <th scope="col">Tipo de Ingreso</th>
                                <th scope="col">Concepto Ingreso</th>
                                <th scope="col">Fec. Registro</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ingresos as $ingreso)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $ingreso->tipo_ingreso }}
                                        </td>
                                        <td>
                                            {{ optional(optional($ingreso)->concepto_ingreso)->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional($ingreso)->fecha_registro }}
                                        </td>
                                        <td>
                                            {{ optional($ingreso)->monto }}
                                        </td>
                                        <td>
                                            {{ optional($ingreso)->fecha_registro }}
                                        </td>
                                        <td>
                                            {{ optional($ingreso)->monto }}
                                        </td>
                                        <td>
                                            @if($ingreso->estado == 1)
                                                <span class="badge bg-success">{{ $ingreso->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $ingreso->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($ingreso->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $ingreso->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $ingreso->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $ingreso->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $ingresos->links() }}
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
                            <label for="tipo" class="col-form-label">Concepto de Ingreso</label>
                            <select class="form-control" id="tipo" name="state" wire:model='form.tipo'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($conceptos_ingresos as $concepto_ingreso)
                                    <option value="{{ $concepto_ingreso->id }}">{{ $concepto_ingreso->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="tipo_ingreso_id" class="col-form-label">Estudiante:</label>
                            <select class="js-example-basic-single" id="estudiante_id" name="state" wire:model='form.tipo_ingreso_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id }}">{{ $estudiante->nro_estudiante }}</option>
                                @endforeach
                            </select>
                        </div>          
                        <div class="mb-3">
                            <label for="nombres" class="col-form-label">Fecha:</label>
                            <input type="date" class="form-control">
                            <div>
                                @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>              
                        <div>
                            @error('form.tipo_ingreso_id') <span class="error">{{ $message }}</span> @enderror
                        </div>                        
                        <div class="mb-3">
                            <label for="monto" class="col-form-label">Monto:</label>
                            <input type="number" class="form-control" id="monto" wire:model='form.monto'>
                            <div>
                                @error('form.monto') <span class="error">{{ $message }}</span> @enderror
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
            $('#estudiante_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#estudiante_id').on('change',function(){
                let a = document.getElementById("estudiante_id").value;
                $wire.set('form.tipo_ingreso_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#estudiante_id').val(event.id);
                $('#estudiante_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#estudiante_id').val(null).trigger('change');
            });
            $('#ciclo_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#ciclo_id').on('change',function(){
                let a = document.getElementById("ciclo_id").value;
                $wire.set('form.ciclo_id',a);
            })
            $wire.on('cambiarSeleccionCiclo', (event) => {
                $('#ciclo_id').val(event.id);
                $('#ciclo_id').trigger('change');
            });
            $wire.on('anularSeleccionCiclo', (event) => {
                $('#ciclo_id').val(null).trigger('change');
            });
            $('#especifica_nivel_2_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#especifica_nivel_2_id').on('change',function(){
                let a = document.getElementById("especifica_nivel_2_id").value;
                $wire.set('form.especifica_nivel_2_id',a);
            })
            $wire.on('cambiarSeleccionEspecifica2', (event) => {
                $('#especifica_nivel_2_id').val(event.id);
                $('#especifica_nivel_2_id').trigger('change');
            });
            $wire.on('anularSeleccionEspecifica2', (event) => {
                $('#especifica_nivel_2_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>
