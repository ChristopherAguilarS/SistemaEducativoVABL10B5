<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">SubGenericas 2</h4>
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
                                <th scope="col">Sub Generica 1</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subgenericas2 as $subgenerica2)
                            <tr>                
                                <td class="font-medium">
                                    {{ $loop->index+1 }}
                                </td>
                                <td>
                                    {{ $subgenerica2->descripcion }}
                                </td>
                                <td>
                                    {{ optional(optional($subgenerica2)->subgenericanivel1)->descripcion }}
                                </td>
                                <td>
                                    @if($subgenerica2->estado == 1)
                                        <span class="badge bg-success">{{ $subgenerica2->nEstado }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $subgenerica2->nEstado }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($subgenerica2->estado == 1)
                                        <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $subgenerica2->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                    
                                    @else
                                        <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $subgenerica2->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                    @endif
                                        <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $subgenerica2->id }})'>Editar <i class="las la-edit"></i></button>
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $subgenericas2->links() }}
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
                            <input type="text" class="form-control" id="descripcion" wire:model='form.descripcion'>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="sub_generica_nivel_1_id" class="col-form-label">Generica:</label>
                            <select class="js-example-basic-single" id="sub_generica_nivel_1_id" name="state" wire:model='form.sub_generica_nivel_1_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($subgenericas as $subgenerica)
                                    <option value="{{ $subgenerica->id }}">{{ $subgenerica->codigo }} - {{ $subgenerica->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.sub_generica_nivel_1_id') <span class="error">{{ $message }}</span> @enderror
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
            $('#sub_generica_nivel_1_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#sub_generica_nivel_1_id').on('change',function(){
                let a = document.getElementById("sub_generica_nivel_1_id").value;
                $wire.set('form.sub_generica_nivel_1_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#sub_generica_nivel_1_id').val(event.id);
                $('#sub_generica_nivel_1_id').trigger('change');
            });
        </script>
    @endscript
</div>
