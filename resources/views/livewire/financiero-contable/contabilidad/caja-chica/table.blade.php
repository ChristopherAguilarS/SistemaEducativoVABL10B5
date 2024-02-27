<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Caja Chica</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                        </div>
                    </div>
                </div><!-- end card header -->
                @livewire('financiero-contable.contabilidad.caja-chica.cards')
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Cuenta</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movimientos as $movimiento)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $movimiento->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional(optional($movimiento)->cuenta)->descripcion }}
                                        </td>
                                        <td>
                                            @if(optional($movimiento)->fecha != null)
                                                {{ Carbon\Carbon::parse($movimiento->fecha)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $movimiento->nTipo }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($movimiento->monto, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($movimiento->estado == 1)
                                                <span class="badge bg-success">{{ $movimiento->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $movimiento->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($movimiento->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $movimiento->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $movimiento->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $movimiento->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $movimientos->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!-- Default Modals -->
    <div wire:ignore.self id="myModal" class="modal fade modal-lg" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-3">
                                <label for="fecha" class="col-form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" wire:model='form.fecha'>
                                <div>
                                    @error('form.fecha') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-9">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <input type="text" class="form-control" id="descripcion" wire:model='form.descripcion'>
                                <div>
                                    @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="tipo" class="col-form-label">Tipo:</label>
                                <select {{ $deshabilitar }} class="form-control" id="tipo" name="state" wire:model.live='form.tipo'>
                                    <option value="">Seleccionar Opcion</option>
                                    <option value="1">Ingreso</option>
                                    <option value="2">Egreso</option>
                                </select>
                                <div>
                                    @error('form.tipo') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="categoria_id" class="col-form-label">Categoria:</label>
                                @if($apertura == false && $cierre == false)
                                    <select class="form-control" id="categoria_id" name="state" wire:model.live='form.categoria_id'>
                                        <option value="">Seleccionar Opcion</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                                        @endforeach
                                    </select>
                                @elseif($apertura == true)
                                    <select {{ $deshabilitar }} class="form-control" id="categoria_id" name="categoria_id" wire:model='form.categoria_id'>
                                        <option value="1">Aperturar Caja Chica</option>
                                    </select>
                                @elseif($cierre == true)
                                    <select {{ $deshabilitar }} class="form-control" id="categoria_id" name="categoria_id" wire:model='form.categoria_id'>
                                        <option value="8">Cerrar Caja Chica</option>
                                    </select>
                                @endif
                                <div>
                                    @error('form.categoria_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            {{-- <div class="mb-3 col-3">
                                <label for="categoria_id" class="col-form-label">Categoria: {{ $form->categoria_id }}</label>
                                <select {{ $deshabilitar }} class="form-control" name="categoria" id="categoria_id" wire:model.live='form.categoria_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                                    @endforeach
                                </select>                                                     
                                <div>
                                    @error('form.categoria_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>   --}}
                            <div class="mb-3 col-6"> 
                                <label for="descripcion" class="col-form-label">Descripcion del Movimiento:</label>
                                <input type="text" class="form-control" placeholder="Descripcion del movimiento" id="descripcion" wire:model='form.descripcion_categoria'>
                                <div>
                                    @error('form.descripcion_categoria') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="monto" class="form-label">Monto:</label>
                                <input 
                                @if($cierre) 
                                    disabled
                                @endif
                                type="number" class="form-control" placeholder="Monto" id="monto" wire:model='form.monto'>
                                <div>
                                    @error('form.monto') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @if($form->tipo == 2)
                            <div class="mb-3 col-3">
                                <label for="comprobante" class="form-label">Comprobante:</label>
                                <input {{ $deshabilitar }} type="text" class="form-control" placeholder="Comprobante" id="comprobante" wire:model='form.comprobante'>
                                <div>
                                    @error('form.comprobante') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @endif     
                            <div class="mb-3 col-6" wire:ignore>
                                <label for="cuenta_id" class="form-label">Cuenta:</label>
                                <select {{ $deshabilitar }} class="js-example-basic-single" id="cuenta_id" name="state" wire:model='form.cuenta_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($cuentas as $cuenta)
                                        <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>                        
                            <div>
                                @error('form.cuenta_id') <span class="error">{{ $message }}</span> @enderror
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
            $('#cuenta_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#cuenta_id').on('change',function(){
                let a = document.getElementById("cuenta_id").value;
                $wire.set('form.cuenta_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#cuenta_id').val(event.id);
                $('#cuenta_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#cuenta_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>