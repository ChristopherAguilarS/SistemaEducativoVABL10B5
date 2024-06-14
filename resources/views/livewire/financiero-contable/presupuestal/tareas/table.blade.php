<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tareas</h4>
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
                                <th scope="col">Descripcion</th>
                                <th scope="col">Indicador</th>
                                <th scope="col">% Avance</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tareas as $tarea)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            G. {{ $tarea->indicador->actividad_operativa->objetivo_estrategico->codigo }}.{{ $tarea->indicador->actividad_operativa->codigo }}.{{ $tarea->indicador->codigo }}.{{ $tarea->codigo }}. {{ $tarea->descripcion }}
                                        </td>
                                        <td>
                                            I. {{ $tarea->indicador->actividad_operativa->objetivo_estrategico->codigo }}.{{ $tarea->indicador->actividad_operativa->codigo }}.{{ $tarea->indicador->codigo }} - {{ $tarea->indicador->descripcion }}
                                        </td>
                                        <td>
                                            {{ $tarea->meta_ejecutada }}
                                        </td>
                                        <td>
                                            @if($tarea->estado == 1)
                                                <span class="badge bg-success">{{ $tarea->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $tarea->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 250px;">
                                            @if($tarea->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $tarea->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $tarea->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $tarea->id }})'>Editar <i class="las la-edit"></i></button>
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
                            <div class="mb-3 col-12">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='form.descripcion'></textarea>
                                <div>
                                    @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>                                                  
                            <div class="mb-3 col-12" wire:ignore>
                                <label for="indicador_id" class="col-form-label">Indicador:</label>
                                <select class="js-example-basic-single" id="indicador_id" name="state" wire:model='form.indicador_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($indicadores as $indicador)
                                        <option value="{{ $indicador->id }}">{{ $indicador->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>                                                                             
                            <div class="mb-3 col-12">
                                @error('form.indicador_id') <span class="error">{{ $message }}</span> @enderror
                            </div> 
                            <div class="mb-3 col-3">
                                <label for="meta" class="col-form-label">% de Meta Indicador:</label>
                                <input type="range" id="ageInputId" value="100" min="1" max="100" wire:model='form.meta'  oninput="ageOutputId.value = ageInputId.value">
                                <output id="ageOutputId">100</output>%
                                <div>
                                    @error('form.meta') <span class="error">{{ $message }}</span> @enderror
                                </div>
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
        </script>
    @endscript
</div>

