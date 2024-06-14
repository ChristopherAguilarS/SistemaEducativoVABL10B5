<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 400px">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tareas</h4>
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
                                    <th scope="col">Codigo</th>
                                    <th scope="col">% Avance</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tareas as $tarea)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td class="font-medium">
                                            G. {{ $tarea->indicador->actividad_operativa->objetivo_estrategico->codigo }}.{{ $tarea->indicador->actividad_operativa->codigo }}.{{ $tarea->indicador->codigo }}.{{ $tarea->codigo }}
                                            <button type="button" class="btn btn-primary rounded-pill bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalTooltipT" wire:click='tooltip({{ $tarea->id }})'><i class="las la-search"></i></button></td>
                                        </td>
                                        <td>
                                            @if($tarea->porcentaje_avance > 0 && $tarea->porcentaje_avance != null)
                                                {{ number_format($tarea->porcentaje_avance, 2) }} %
                                            @else
                                                0.00 %
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info rounded-pill bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#tareaModal" wire:click='tareasEjecutadasP({{ $tarea->id }})'><i class="las la-plus"></i></button></td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $tareas->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!-- Default Modals -->
    <div wire:ignore.self id="myModalTareaEjecutada" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloTareaEjecutada }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="descripcion" class="col-form-label">Descripcion:</label>
                                    <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='formTarea.descripcion'></textarea>
                                    <div>
                                        @error('formTarea.descripcion') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div> 
                            <div class="col-4">
                                <div>
                                    <label for="inlineRadio" class="col-form-label">Tipo Requerimiento:</label>
                                </div>
                                <div class="mb-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="1" wire:model='form.tipo_requerimiento'>
                                        <label class="form-check-label" for="inlineRadio1">Requerimiento</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="2" wire:model='form.tipo_requerimiento'>
                                        <label class="form-check-label" for="inlineRadio2">Caja Chica</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="nro_pedido" class="col-form-label">N° Pedido:</label>
                                    <input type="number" class="form-control" id="nro_pedido" wire:model='formTarea.nro_pedido'>
                                    <div>
                                        @error('formTarea.nro_pedido') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="tipo_comprobante" class="col-form-label">Tipo de Comprobante:</label>
                                    <select class="form-select" aria-label="Objetivo Estrategico" wire:model.live="objetivo_estrategico_id">
                                        <option selected="">Seleccione Tipo de Comprobante </option>
                                        <option selected="1">Boleta </option>
                                        <option selected="2">Factura</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="nro_requerimiento" class="col-form-label">N° Comprob.:</label>
                                    <input type="text" class="form-control" id="nro_comprobante" wire:model='formTarea.nro_comprobante'>
                                    <div>
                                        @error('formTarea.nro_comprobante') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>        
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="fecha_emision" class="col-form-label">Fecha de Emision:</label>
                                    <input type="date" class="form-control" wire:model='formTarea.fecha_pago'>
                                    <div>
                                        @error('formTarea.fecha_emision') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>                                      
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="importe" class="col-form-label">Importe:</label>
                                    <input type="number" class="form-control" id="importe" wire:model='formTarea.importe'>
                                    <div>
                                        @error('formTarea.importe') <span class="error">{{ $message }}</span> @enderror
                                    </div>
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
                            <div class="col-12">
                                <div class="mb-3" wire:ignore>
                                    <label for="especifica_nivel_2_id" class="col-form-label">Especifica 2:</label>
                                    <select class="js-example-basic-single" id="especifica_nivel_2_id" name="state" wire:model='formTarea.especifica_nivel_2_id'>
                                        <option value="">Seleccionar Opcion</option>
                                        @foreach ($especificas as $especifica)
                                            <option value="{{ $especifica->id }}">{{ $especifica->codigo }}.{{ $especifica->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>    
                        </div>   
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click='guardarTareaEjecutada'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Default Modals -->
    <div wire:ignore.self id="modalTooltipT" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    @if($tareaSeleccionada != null)
                        <form>
                            <div class="mb-3">
                                <label class="col-form-label">Codigo:</label>
                                <label class="col-form-label">G. {{ $tareaSeleccionada->indicador->actividad_operativa->objetivo_estrategico->codigo }}.{{ $tareaSeleccionada->indicador->actividad_operativa->codigo }}.{{ $tareaSeleccionada->indicador->codigo }}.{{ $tareaSeleccionada->codigo }}</label>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <label class="col-form-label">{{ $tareaSeleccionada->descripcion }}</label>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
        <!-- Default Modals -->
    </div><!-- /.modal -->
    <div wire:ignore.self id="tareaModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloTareas }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive table-card">
                        <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModalTareaEjecutada" wire:click='agregarTareaEjecutada'>
                            <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                        </button>
                        <br>
                        <table class="table table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">N° Comprobante</th>
                                    <th scope="col">Importe</th>
                                    <th scope="col">Fecha Pago</th>
                                    <th scope="col">Clasificador</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tareasEjecutadas as $tarea)
                                    <tr>                
                                        <td class="font-medium">{{ $loop->index+1 }}</td>
                                        <td class="font-medium">{{ $tarea->descripcion }}</td>
                                        <td>{{ $tarea->comprobante }}</td>
                                        <td>{{ $tarea->importe }}</td>
                                        <td>{{ \Carbon\Carbon::parse($tarea->fecha_pago)->format('d/m/Y') }}</td>                                        
                                        <td>{{ optional(optional($tarea)->especificanivel2)->descripcion }}</td>
                                    </tr>
                                @empty
                                    <tr>                
                                        <td colspan="5">No existen registros</td>
                                    </tr>
                                @endforelse
                            </tbody>                            
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @script()
        <script>
            $('#indicador_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#indicador_id').on('change',function(){
                let a = document.getElementById("indicador_id").value;
                $wire.set('form.indicador_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#indicador_id').val(event.id);
                $('#indicador_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#indicador_id').val(null).trigger('change');
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

