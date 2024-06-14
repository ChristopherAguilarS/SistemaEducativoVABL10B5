<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Cursos</h4>
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
                                    <th scope="col">Area</th>
                                    <th scope="col">Turno</th>
                                    <th scope="col">Seccion</th>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Ciclo</th>
                                    <th scope="col">Creditos</th>
                                    <th scope="col">Horas</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $curso)
                                    <tr>                
                                        <td class="font-medium">{{ $loop->index+1 }}</td>                                        
                                        <td>{{ $curso->descripcion }}</td>
                                        <td>
                                            {{ $curso->turno }}
                                        </td>
                                        <td>
                                            {{ $curso->seccion }}
                                        </td>
                                        <td>
                                            {{ $curso->docente_id }}
                                        </td>
                                        <td>
                                            {{ $curso->creditos }}
                                        </td>
                                        <td>
                                            {{ $curso->horas }}
                                        </td>
                                        <td>
                                            @if($curso->estado == 1)
                                                <span class="badge bg-success">{{ $curso->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $curso->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center" style="min-width: 250px;">
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                @if($curso->estado == 1)
                                                    <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $curso->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                                @else
                                                    <button type="button" class="btn btn-success bg-gradient waves-effect waves-light btn-sm me-2" wire:click='cambiarEstado({{ $curso->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                                @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $curso->id }})'>Editar <i class="las la-edit"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{-- {{ $cursos->links() }} --}}
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
                        <div class="mb-3" wire:ignore>
                            <label for="curso_id" class="col-form-label">Curso:</label>
                            <select class="js-example-basic-single" id="curso_id" name="curso_id" wire:model='form.curso_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="ciclo_id" class="col-form-label">Ciclo:</label>
                            <select class="js-example-basic-single" id="ciclo_id" name="ciclo_id" wire:model='form.curso_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($ciclos as $ciclo)
                                    <option value="{{ $ciclo->id }}">{{ $ciclo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="programa_estudio_id" class="col-form-label">Programa de Estudio:</label>
                            <select class="js-example-basic-single" id="programa_estudio_id" name="programa_estudio_id" wire:model='form.curso_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($ciclos as $ciclo)
                                    <option value="{{ $ciclo->id }}">{{ $ciclo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="genero" class="col-form-label">Turno:</label>
                            <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="0">Mañana</option> 
                                <option value="1">Tarde</option> 
                            </select>
                            @error('form.genero') <span class="error">{{ $message }}</span> @enderror
                        </div>                         
                        <div class="mb-3 col-6">
                            <label for="meta" class="col-form-label">Seccion:</label>
                            <input type="text" id="nro_creditos" class="form-control" wire:model='form.meta' >
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
    <!-- Default Modals -->
    <div wire:ignore.self id="myModalP" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                            <label for="meta" class="col-form-label">Creditos:</label>
                            <input type="number" id="nro_creditos" class="form-control" wire:model='form.meta'  oninput="ageOutputId.value = ageInputId.value">
                        </div>  
                        <div class="mb-3" wire:ignore>
                            <label for="curso_equivalencia_id" class="col-form-label">Curso Equivalencia:</label>
                            <select class="js-example-basic-single" id="curso_equivalencia_id" name="curso_equivalencia_id" wire:model='form.curso_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModalRequisito" wire:click='agregar'>
                        <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR PREQUISITO
                    </button>
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
            $('#curso_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#curso_id').on('change',function(){
                let a = document.getElementById("curso_id").value;
                $wire.set('form.curso_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#curso_id').val(event.id);
                $('#curso_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#curso_id').val(null).trigger('change');
            });
            $('#ciclo_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#ciclo_id').on('change',function(){
                let a = document.getElementById("ciclo_id").value;
                $wire.set('form.ciclo_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#ciclo_id').val(event.id);
                $('#ciclo_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#ciclo_id').val(null).trigger('change');
            });
            $('#programa_estudio_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#programa_estudio_id').on('change',function(){
                let a = document.getElementById("programa_estudio_id").value;
                $wire.set('form.programa_estudio_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#programa_estudio_id').val(event.id);
                $('#programa_estudio_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#programa_estudio_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>

