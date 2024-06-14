<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Indicadores</h4>
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
                                <th scope="col">Descripcion</th>
                                <th scope="col">Actividad Operativa</th>
                                <th scope="col">Monto PIA</th>
                                <th scope="col">Monto PIM</th>
                                <th scope="col">Monto Ejecutado</th>
                                <th scope="col">Saldo</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indicadores as $indicador)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            I.{{ $indicador->actividad_operativa->accion_estrategica_priorizada->objetivo_estrategico->codigo }}.{{ $indicador->actividad_operativa->accion_estrategica_priorizada->codigo }}.{{ $indicador->actividad_operativa->codigo }}.{{ $indicador->codigo }}
                                        </td>
                                        <td>
                                            {{ $indicador->descripcion }}
                                        </td>
                                        <td>
                                            AO. 
                                            {{ optional($indicador)->actividad_operativa->accion_estrategica_priorizada->codigo }}.
                                            {{ optional($indicador)->actividad_operativa->codigo }}.
                                            {{ optional($indicador)->actividad_operativa->descripcion }}
                                        </td>
                                        <td>
                                            {{ $indicador->monto_pia }}
                                        </td>
                                        <td>
                                            {{ $indicador->monto_pim }}
                                        </td>                                        
                                        <td>
                                            {{ $indicador->monto_ejecutado }}
                                        </td>
                                        <td>
                                            {{ $indicador->saldo }}
                                        </td>
                                        <td>
                                            @if($indicador->estado == 1)
                                                <span class="badge bg-success">{{ $indicador->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $indicador->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 250px;">
                                            @if($indicador->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $indicador->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light  btn-sm me-2" wire:click='cambiarEstado({{ $indicador->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                            <button type="button" class="btn btn-info bg-gradient waves-effect waves-light  btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $indicador->id }})'>Editar <i class="las la-edit"></i></button>
                                            <button type="button" class="btn btn-info bg-gradient waves-effect waves-light  btn-sm me-2 mt-2" data-bs-toggle="modal" data-bs-target="#myModalPIM" wire:click='agregarPIM({{ $indicador->id }})'>Agregar PIM <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $indicadores->links() }}
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='form.descripcion'></textarea>
                                <div>
                                    @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>                            
                            <div class="mb-3" wire:ignore>
                                <label for="actividad_operativa_id" class="col-form-label">Actividad Operativa:</label>
                                <select class="js-example-basic-single" id="actividad_operativa_id" name="state" wire:model='form.actividad_operativa_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($actividades as $actividad)
                                        <option value="{{ $actividad->id }}">A.{{ $actividad->accion_estrategica_priorizada->objetivo_estrategico->codigo}}.{{ $actividad->accion_estrategica_priorizada->codigo}}.{{ $actividad->codigo}} {{ $actividad->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div>
                                @error('form.actividad_operativa_id') <span class="error">{{ $message }}</span> @enderror
                            </div> 
                            <div class="mb-3 col-2">
                                <label for="fecha_inicio" class="col-form-label">Fecha Inicio:</label>
                                <input type="date" class="form-control" wire:model='form.fecha_inicio'>
                                <div>
                                    @error('form.fecha_inicio') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>                            
                            <div class="mb-3 col-2">
                                <label for="fecha_fin" class="col-form-label">Fecha Fin:</label>
                                <input type="date" class="form-control" wire:model='form.fecha_fin'>
                                <div>
                                    @error('form.fecha_fin') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-2">
                                <label for="meta" class="col-form-label">Meta:</label>
                                <input type="number" min="0" and max="5" class="form-control" id="meta" wire:model='form.meta'>
                                <div>
                                    @error('form.meta') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>                  
                            <div class="mb-3 col-2">
                                <label for="monto" class="col-form-label">Monto Asignado:</label>
                                <input type="number" class="form-control" id="monto" wire:model='form.monto_asignado'>
                                <div>
                                    @error('form.monto_asignado') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="bienes_servicios" class="col-form-label">Bienes y Servicios:</label>
                                <textarea class="form-control" id="bienes_servicios" rows="3" placeholder="Bienes y Servicios" wire:model='form.bienes_servicios'></textarea>
                                <div>
                                    @error('form.bienes_servicios') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="responsables" class="col-form-label">Responsables:</label>
                                <textarea class="form-control" id="responsables" rows="3" placeholder="Responsables" wire:model='form.responsables'></textarea>
                                <div>
                                    @error('form.responsables') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-6" wire:ignore>
                                <label for="responsable_id" class="col-form-label">Responsables:</label>
                                <select class="js-example-basic-single" id="responsable_id" name="responsable" wire:model='form.responsable_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($responsables as $responsable)
                                        <option value="{{ $responsable->id }}">{{ $responsable->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="bienes_servicios" class="col-form-label">Tareas:</label>
                                <div class="row">
                                    <div class="mb-3 col-9">
                                        <input type="text" class="form-control" id="tarea" wire:model='tarea'>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <button wire:click='adjuntarTarea' type="button" class="btn btn-danger">Agregar Tarea</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-12">
                                <table class="table table-striped-columns mb-4">
                                    <thead>
                                        <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Tarea</th>
                                        <th scope="col" class="!text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tareasAdjuntas as $tarea)
                                            <tr>                
                                                <td class="font-medium">
                                                    {{ $loop->index+1 }}
                                                </td>
                                                <td>
                                                    {{ $tarea['descripcion'] }}
                                                </td>                                                
                                                <td class="text-center" style="min-width: 250px;">
                                                    <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light  btn-sm me-2" wire:click='retirarTarea({{ $loop->index }})'>Eliminar <i class="las la-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    <div wire:ignore.self id="myModalPIM" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloPIM }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='formDetalle.descripcion'></textarea>
                                <div>
                                    @error('formDetalle.descripcion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>   
                            <div class="mb-3 col-2">
                                <label for="resolucion" class="col-form-label">N° Resolucion:</label>
                                <input type="text" class="form-control" wire:model='formDetalle.resolucion'>
                                <div>
                                    @error('formDetalle.resolucion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div> 
                            <div class="col-10">
                                <label for="nro_requerimiento" class="col-form-label">Resolucion (pdf):</label>
                                <input class="form-control" id="formFileSm" type="file" wire:model='formDetalle.documento' accept="application/pdf">
                            </div>                           
                            <div class="mb-3 col-2">
                                <label for="fecha" class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" wire:model='formDetalle.fecha'>
                                <div>
                                    @error('formDetalle.fecha') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>                
                            <div class="mb-3 col-2">
                                <label for="monto" class="col-form-label">Monto:</label>
                                <input type="number" class="form-control" id="monto" wire:model='formDetalle.importe'>
                                <div>
                                    @error('formDetalle.importe') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardarPIM'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @script()
        <script>
            $('#actividad_operativa_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#actividad_operativa_id').on('change',function(){
                let a = document.getElementById("actividad_operativa_id").value;
                $wire.set('form.actividad_operativa_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#actividad_operativa_id').val(event.id);
                $('#actividad_operativa_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#actividad_operativa_id').val(null).trigger('change');
            });
            
            $('#responsable_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#responsable_id').on('change',function(){
                let a = document.getElementById("responsable_id").value;
                $wire.set('form.responsable_id',a);
            })
            $wire.on('cambiarSeleccionR', (event) => {
                $('#responsable_id').val(event.id);
                $('#responsable_id').trigger('change');
            });
            $wire.on('anularSeleccionR', (event) => {
                $('#responsable_id').val(null).trigger('change');
            });             
        </script>
    @endscript
</div>

