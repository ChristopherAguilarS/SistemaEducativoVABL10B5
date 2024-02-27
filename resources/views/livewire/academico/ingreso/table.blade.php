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
                                <th scope="col">Tipo de Ingreso</th>
                                <th scope="col">Ciclo</th>
                                <th scope="col">Especifica Nivel 2</th>
                                <th scope="col">Fec. Vigencia</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($conceptoIngresos as $concepto_ingreso)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $concepto_ingreso->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional(optional($concepto_ingreso)->tipoIngreso)->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional(optional($concepto_ingreso)->ciclo)->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional(optional($concepto_ingreso)->especificanivel2)->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional($concepto_ingreso)->fecha_vigencia }}
                                        </td>
                                        <td>
                                            {{ optional($concepto_ingreso)->monto }}
                                        </td>
                                        <td>
                                            @if($concepto_ingreso->estado == 1)
                                                <span class="badge bg-success">{{ $concepto_ingreso->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $concepto_ingreso->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($concepto_ingreso->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $concepto_ingreso->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $concepto_ingreso->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $concepto_ingreso->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $conceptoIngresos->links() }}
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
                        <div class="mb-3">
                            <label for="tipo" class="col-form-label">Ingreso con Vigencia?</label>
                            <select class="form-control" id="tipo" name="state" wire:model='form.tipo'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_vigencia" class="col-form-label">Fecha Vigencia:</label>
                            <input type="date" class="form-control" wire:model='form.fecha_vigencia'>
                            <div>
                                @error('form.fecha_vigencia') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="tipo_ingreso_id" class="col-form-label">Tipo de Ingreso:</label>
                            <select class="js-example-basic-single" id="tipo_ingreso_id" name="state" wire:model='form.tipo_ingreso_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($tipo_ingresos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.tipo_ingreso_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="ciclo_id" class="col-form-label">Ciclo:</label>
                            <select class="js-example-basic-single" id="ciclo_id" name="state" wire:model='form.ciclo_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($ciclos as $ciclo)
                                    <option value="{{ $ciclo->id }}">{{ $ciclo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.ciclo_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="especifica_nivel_2_id" class="col-form-label">Especifica Nivel 2:</label>
                            <select class="js-example-basic-single" id="especifica_nivel_2_id" name="state" wire:model='form.especifica_nivel_2_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($especificas2 as $especifica)
                                    <option value="{{ $especifica->id }}">{{ $especifica->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.especifica_nivel_2_id') <span class="error">{{ $message }}</span> @enderror
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
            $('#tipo_ingreso_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#tipo_ingreso_id').on('change',function(){
                let a = document.getElementById("tipo_ingreso_id").value;
                $wire.set('form.tipo_ingreso_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#tipo_ingreso_id').val(event.id);
                $('#tipo_ingreso_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#tipo_ingreso_id').val(null).trigger('change');
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
