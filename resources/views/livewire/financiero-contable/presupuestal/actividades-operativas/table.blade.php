<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Actividades Operativas</h4>
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
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actividadOperativas as $actividadOperativa)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $actividadOperativa->descripcion }}
                                        </td>
                                        <td>
                                            @if($actividadOperativa->estado == 1)
                                                <span class="badge bg-success">{{ $actividadOperativa->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $actividadOperativa->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($actividadOperativa->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $actividadOperativa->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $actividadOperativa->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $actividadOperativa->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $actividadOperativas->links() }}
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
                            <label for="codigo" class="col-form-label">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" wire:model='form.codigo'>
                            <div>
                                @error('form.codigo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripcion:</label>
                            <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion" wire:model='form.descripcion'></textarea>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="plan_anual_trabajo_id" class="col-form-label">Plan Anual:</label>
                            <select class="js-example-basic-single" id="plan_anual_trabajo_id" name="state" wire:model='form.plan_anual_trabajo_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($plan_anuales as $plan_anual)
                                    <option value="{{ $plan_anual->id }}">{{ $plan_anual->año }} - {{ $plan_anual->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="objetivo_estrategico_id" class="col-form-label">Objetivo Estrategico:</label>
                            <select class="js-example-basic-single" id="objetivo_estrategico_id" name="state" wire:model='form.objetivo_estrategico_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($objetivos_estrategicos as $objetivo_estrategico)
                                    <option value="{{ $objetivo_estrategico->id }}">{{ $objetivo_estrategico->codigo }} - {{ $objetivo_estrategico->descripcion }}</option>
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
        </script>
        <script>
            $('#objetivo_estrategico_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#objetivo_estrategico_id').on('change',function(){
                let a = document.getElementById("objetivo_estrategico_id").value;
                $wire.set('form.objetivo_estrategico_id',a);
            })
            $wire.on('cambiarSeleccionOE', (event) => {
                $('#objetivo_estrategico_id').val(event.id);
                $('#objetivo_estrategico_id').trigger('change');
            });
            $wire.on('anularSeleccionOE', (event) => {
                $('#objetivo_estrategico_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>

