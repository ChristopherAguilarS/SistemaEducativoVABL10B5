<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Objetivos Estrategicos</h4>
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
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Procesos</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($objetivoEstrategicos as $objetivoEstrategico)
                                    <tr>                
                                        <td class="font-medium">{{ $loop->index+1 }}</td>
                                        <td class="font-medium">OE.{{ $objetivoEstrategico->codigo }}.</td>
                                        <td>{{ $objetivoEstrategico->descripcion }}</td>
                                        <td>{{ $objetivoEstrategico->procesos_objetivos_estrategicos->pluck('proceso.descripcion')->implode(', ') }}</td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($objetivoEstrategico->monto_asignado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($objetivoEstrategico->saldo, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($objetivoEstrategico->estado == 1)
                                                <span class="badge bg-success">{{ $objetivoEstrategico->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $objetivoEstrategico->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 350px;">
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                @if($objetivoEstrategico->estado == 1)
                                                    <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $objetivoEstrategico->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-success bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $objetivoEstrategico->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $objetivoEstrategico->id }})'>Editar <i class="las la-edit"></i></button>
                                                <button type="button" class="btn btn-info bg-primary waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModalProceso" wire:click='agregarProcesos({{ $objetivoEstrategico->id }})'>Procesos <i class="las la-procedures"></i></button>
                                            </div>
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
                        <div class="mb-3">
                            <label for="monto" class="col-form-label">Monto Asignado:</label>
                            <input type="number" min="0" class="form-control" id="monto" wire:model='form.monto_asignado'>
                            <div>
                                @error('form.monto') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="plan_anual_trabajo_id" class="col-form-label">Plan Anual:</label>
                            <select class="js-example-basic-single" id="plan_anual_trabajo_id" name="plan_anual_trabajo_id" wire:model='form.plan_anual_trabajo_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($plan_anuales as $plan_anual)
                                    <option value="{{ $plan_anual->id }}">{{ $plan_anual->año_academico->año }} - {{ $plan_anual->nombre }}</option>
                                @endforeach
                            </select>
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
    <div wire:ignore.self id="myModalProceso" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloProceso }}</h5>
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
                        <div class="row">
                            <div class="mb-3 col-10" wire:ignore>
                                <label for="proceso_id" class="col-form-label">Proceso:</label>
                                <select class="js-example-basic-single" id="proceso_id" name="proceso_id" wire:model='proceso_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($procesos as $proceso)
                                        <option value="{{ $proceso->id }}">{{ $proceso->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 mt-5">
                                <button type="button" class="btn btn-danger bg-danger waves-effect waves-light btn-sm me-2" wire:click='adjuntarProceso'>Agregar Proceso <i class="las la-plus"></i></button>
                            </div>                            
                        </div>         
                        <div class="table-responsive table-card">
                            <table class="table table-striped-columns mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Procesos</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($procesosSeleccionados as $proceso)
                                        <tr>                
                                            <td class="font-medium">{{ $loop->index+1 }}</td>
                                            <td class="font-medium">{{ $proceso['proceso_descripcion'] }}</td>                                            
                                            <td class="text-center" style="min-width: 250px;">
                                                <div class="btn-group" role="group" aria-label="Acciones">
                                                    <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='retirarProceso({{ $loop->index }})'>Eliminar <i class="las la-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                           <td colspan="4">
                                            No hay procesos agregados aún.
                                            </td> 
                                        </tr>
                                    @endforelse
                                </tbody>                            
                            </table>
                        </div>   
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardarProcesos'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @script()
        <script>
            $('#plan_anual_trabajo_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#plan_anual_trabajo_id').on('change',function(){
                let a = document.getElementById("plan_anual_trabajo_id").value;
                $wire.set('form.plan_anual_trabajo_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#plan_anual_trabajo_id').val(event.id);
                $('#plan_anual_trabajo_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#plan_anual_trabajo_id').val(null).trigger('change');
            });
            $('#proceso_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModalProceso'
            });
            $('#proceso_id').on('change',function(){
                let a = document.getElementById("proceso_id").value;
                $wire.set('proceso_id',a);
            })
            $wire.on('cambiarSeleccionP', (event) => {
                $('#proceso_id').val(event.id);
                $('#proceso_id').trigger('change');
            });
            $wire.on('anularSeleccionP', (event) => {
                $('#proceso_id').val(null).trigger('change');
            });
        </script>
        
    @endscript
</div>

