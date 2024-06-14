<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 400px">
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
                                <th scope="col">Monto Asignado</th>
                                <th scope="col">Monto Ejecutado</th>
                                <th scope="col">Saldo</th>
                                <th scope="col">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($indicadores as $indicador)
                                    <tr wire:click="seleccionarFila({{ $indicador->id }})"
                                        @if($filaSeleccionada == $indicador->id)
                                            class="table-active"
                                        @endif>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            I. {{ $indicador->actividad_operativa->accion_estrategica_priorizada->objetivo_estrategico->codigo }}.{{ $indicador->actividad_operativa->accion_estrategica_priorizada->codigo }}.{{ $indicador->actividad_operativa->codigo }}.{{ $indicador->codigo }}
                                            <button type="button" class="btn btn-primary rounded-pill bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalTooltipI" wire:click='tooltip({{ $indicador->id }})'><i class="las la-search"></i></button></td>
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($indicador->monto_asignado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($indicador->monto_ejecutado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($indicador->saldo, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($indicador->monto_asignado > 0 && $indicador->monto_asignado != null)
                                                {{ number_format($indicador->monto_ejecutado/$indicador->monto_asignado, 2)*100 }} %
                                            @else
                                                0.00 %
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info rounded-pill bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#tareaModal" wire:click='tareasEjecutadasP({{ $indicador->id }})'><i class="las la-plus"></i></button></td>
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
    <div wire:ignore.self id="modalTooltipI" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    @if($indicadorSeleccionado != null)
                        <form>
                            <div class="mb-3">
                                <label class="col-form-label">Codigo:</label>
                                <label class="col-form-label">{{ $indicadorSeleccionado->codigo }}</label>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <label class="col-form-label">{{ $indicadorSeleccionado->descripcion }}</label>
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
    <div wire:ignore.self id="modalTooltipT" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    @if($indicadorSeleccionado != null)
                        <form>
                            <div class="mb-3">
                                <label class="col-form-label">Codigo:</label>
                                <label class="col-form-label">G. {{ $indicadorSeleccionado->actividad_operativa->accion_estrategica_priorizada->objetivo_estrategico->codigo }}.{{ $indicadorSeleccionado->actividad_operativa->accion_estrategica_priorizada->codigo }}.{{ $indicadorSeleccionado->codigo }}</label>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <label class="col-form-label">{{ $indicadorSeleccionado->descripcion }}</label>
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
                                    <th scope="col">Documento</th>
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
                                        <td>
                                            @if(optional($tarea)->ruta_documento_sustento != null)
                                                <a href="{{ url(optional($tarea)->ruta_documento_sustento) }}" target="_blank">{{ $tarea->comprobante }}</a>
                                            @endif
                                        </td>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio" value="1" wire:model='formTarea.tipo_requerimiento'>
                                        <label class="form-check-label" for="inlineRadio1">Requerimiento</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio" value="2" wire:model='formTarea.tipo_requerimiento'>
                                        <label class="form-check-label" for="inlineRadio2">Caja Chica</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3">
                                    <label for="nro_requerimiento" class="col-form-label">N° Pedido:</label>
                                    <input type="number" class="form-control" id="nro_requerimiento" wire:model='formTarea.nro_requerimiento'>
                                    <div>
                                        @error('formTarea.nro_requerimiento') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="tipo_comprobante" class="col-form-label">Tipo de Comprobante:</label>
                                    <select class="form-select" aria-label="Objetivo Estrategico" wire:model.live="formTarea.tipo_comprobante">
                                        <option value="">Seleccione Tipo de Comprobante </option>
                                        <option value="1">Boleta </option>
                                        <option value="2">Factura</option>
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
                            <div class="col-12">
                                <label for="nro_requerimiento" class="col-form-label">Documento (pdf):</label>
                                <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
                            </div>      
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="fecha_emision" class="col-form-label">Fecha de Emision:</label>
                                    <input type="date" class="form-control" wire:model='formTarea.fecha_emision'>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardarTareaEjecutada'>Guardar</button>
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
                dropdownParent: '#myModalTareaEjecutada'
            });
            $('#responsable_id').on('change',function(){
                let a = document.getElementById("responsable_id").value;
                $wire.set('formTarea.responsable_id',a);
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
                dropdownParent: '#myModalTareaEjecutada'
            });
            $('#especifica_nivel_2_id').on('change',function(){
                let a = document.getElementById("especifica_nivel_2_id").value;
                $wire.set('formTarea.especifica_nivel_2_id',a);
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

