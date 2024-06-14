<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Responsables</h4>
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
                                <th scope="col">Tipo</th>
                                <th scope="col">Area/Persona</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($responsables as $responsable)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $responsable->descripcion }}
                                        </td>
                                        <td class="text-center" style="min-width: 100px;">
                                            @if($responsable->tipo_responsable == 1)
                                                <span class="badge bg-success">Usuario</span>
                                            @else
                                                <span class="badge bg-danger">Area</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 100px;">
                                            @if($responsable->tipo_responsable == 1)
                                                {{ $responsable->responsable->name }}
                                            @else
                                                {{ $responsable->responsables->descripcion }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($responsable->estado == 1)
                                                <span class="badge bg-success">{{ $responsable->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $responsable->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 250px;">
                                            @if($responsable->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $responsable->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $responsable->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $responsable->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $responsables->links() }}
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
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='form.descripcion'></textarea>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div>
                            <label for="inlineRadio" class="col-form-label">Tipo Responsable:</label>
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio1" value="1" wire:model.live='form.tipo_responsable'>
                                <label class="form-check-label" for="inlineRadio1">Usuario</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions2" id="inlineRadio2" value="2" wire:model.live='form.tipo_responsable'>
                                <label class="form-check-label" for="inlineRadio2">Area</label>
                            </div>
                        </div>
                        <div>
                            @error('form.tipo_responsable') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div style="display: 
                            @if($form->tipo_responsable == 1)
                                block
                            @else
                                none
                            @endif
                            ;">
                            <div class="mb-3" wire:ignore>
                                <label for="responsable_id" class="col-form-label">Usuario:</label>
                                <select class="select2 form-control" id="responsable_id" name="responsable_id" wire:model='form.responsable_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="display: 
                            @if($form->tipo_responsable == 2)
                                block
                            @else
                                none
                            @endif
                            ;">                      
                            <div class="mb-3" wire:ignore>
                                <label for="responsables_id" class="col-form-label">Area:</label>
                                <select class="select2 form-control" id="responsables_id" name="responsables_id" wire:model='form.responsables_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                    @endforeach
                                </select>
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
            $('#responsables_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#responsables_id').on('change',function(){
                let a = document.getElementById("responsables_id").value;
                $wire.set('form.responsables_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#responsables_id').val(event.id);
                $('#responsables_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#responsables_id').val(null).trigger('change');
            });
            $('#responsable_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#responsable_id').on('change',function(){
                let a = document.getElementById("responsable_id").value;
                $wire.set('form.responsable_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#responsable_id').val(event.id);
                $('#responsable_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#responsable_id').val(null).trigger('change');
            });
        </script>
        
    @endscript
</div>

