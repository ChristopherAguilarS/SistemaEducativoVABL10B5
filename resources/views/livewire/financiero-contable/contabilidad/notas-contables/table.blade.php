<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">NOTAS CONTABLES</h4>
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
                                <th scope="col">Cuenta Debe</th>
                                <th scope="col">Monto Debe</th>
                                <th scope="col">Cuenta Haber</th>
                                <th scope="col">Monto Haber</th>
                                <th scope="col">Monto Haber</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notas as $nota)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $nota->cuenta_debe->descripcion }}
                                        </td>
                                        <td>
                                            {{ $nota->monto_debe }}
                                        </td>
                                        <td>
                                            {{ $nota->cuenta_haber->descripcion }}
                                        </td>
                                        <td>
                                            {{ $nota->monto_haber }}
                                        </td>
                                        <td>
                                            @if(optional($nota)->fecha != null)
                                                {{ Carbon\Carbon::parse($nota->fecha)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($nota->estado == 1)
                                                <span class="badge bg-success">{{ $nota->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $nota->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($nota->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $nota->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $nota->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $nota->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $notas->links() }}
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
                        {{-- <div class="mb-3">
                            <label for="codigo" class="col-form-label">Codigo:</label>
                            <input type="text" class="form-control" id="codigo" wire:model='form.codigo'>
                            <div>
                                @error('form.codigo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" wire:model='form.descripcion'>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" wire:model='form.fecha'>
                            <div>
                                @error('form.fecha') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        Debe
                                    </div>
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row align-items-center g-3">
                                                <div class="mb-3" wire:ignore>
                                                    <label for="cuenta_haber_id" class="col-form-label">Cuenta:</label>
                                                    <select class="js-example-basic-single" id="cuenta_haber_id" name="state" wire:model='form.cuenta_haber_id'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        @foreach ($cuentas as $cuenta)
                                                            <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    @error('form.cuenta_haber_id') <span class="error">{{ $message }}</span> @enderror
                                                </div>     
                                                <div class="mb-3">
                                                    <label for="monto_haber" class="form-label">Monto</label>
                                                    <input type="number" class="form-control" placeholder="Monto" id="monto_haber" wire:model='form.monto_haber'>
                                                    <div>
                                                        @error('form.monto_haber') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        Haber
                                    </div>
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="row align-items-center g-3">
                                                <div class="mb-3" wire:ignore>
                                                    <label for="cuenta_debe_id" class="col-form-label">Cuenta:</label>
                                                    <select class="js-example-basic-single" id="cuenta_debe_id" name="state" wire:model='form.cuenta_debe_id'>
                                                        <option value="">Seleccionar Opcion</option>
                                                        @foreach ($cuentas as $cuenta)
                                                            <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    @error('form.cuenta_debe_id') <span class="error">{{ $message }}</span> @enderror
                                                </div> 
                                                <div class="mb-3">
                                                    <label for="monto_debe" class="form-label">Monto</label>
                                                    <input type="number" class="form-control" placeholder="Monto" id="monto_debe" wire:model='form.monto_debe'>
                                                    <div>
                                                        @error('form.monto_debe') <span class="error">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                           
                        
                        
                        {{-- <div class="mb-3">
                            <label for="tipo" class="col-form-label">Tipo:</label>
                            <select class="form-control" id="tipo" name="state" wire:model='form.tipo'>
                                <option value="">Seleccionar Opcion</option>
                                <option value="1">Debe</option>
                                <option value="2">Haber</option>
                            </select>
                            <div>
                                @error('form.fecha') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}    
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
            $('#cuenta_haber_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#cuenta_haber_id').on('change',function(){
                let a = document.getElementById("cuenta_haber_id").value;
                $wire.set('form.cuenta_haber_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#cuenta_haber_id').val(event.id);
                $('#cuenta_haber_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#cuenta_haber_id').val(null).trigger('change');
            });
            $('#cuenta_debe_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#cuenta_debe_id').on('change',function(){
                let a = document.getElementById("cuenta_debe_id").value;
                $wire.set('form.cuenta_debe_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#cuenta_debe_id').val(event.id);
                $('#cuenta_debe_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#cuenta_debe_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>
