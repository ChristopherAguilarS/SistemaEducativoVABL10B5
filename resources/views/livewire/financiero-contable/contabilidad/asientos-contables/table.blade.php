<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">ASIENTOS CONTABLES</h4>
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
                                <th scope="col">Fecha</th>
                                <th scope="col">Monto Debe</th>
                                <th scope="col">Monto Haber</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asientos as $asiento)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $asiento->descripcion }}
                                        </td>                                        
                                        <td>
                                            @if(optional($asiento)->fecha != null)
                                                {{ Carbon\Carbon::parse($asiento->fecha)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($asiento->detalle_debe->sum('monto'), in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($asiento->detalle_haber->sum('monto'), in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($asiento->estado == 1)
                                                <span class="badge bg-success">{{ $asiento->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $asiento->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($asiento->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $asiento->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $asiento->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $asiento->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $asientos->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!-- Default Modals -->
    <div wire:ignore.self class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                        <div class="row">
                                            <div class="col-4">
                                                Debe
                                            </div>
                                            <div class="col-5">
                                            </div>
                                            <div class="col-3">
                                                {{ Illuminate\Support\Number::currency($totalDebe, in: 'S/.', locale: 'en') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModalCuenta" wire:click='agregarDebe'>
                                                <i class="mdi mdi-plus">Agregar Cuenta Contable</i>
                                            </button>                                            
                                            <hr>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Cuenta Contable</th>
                                                        <th>Monto</th>
                                                        <th>Accion</th>
                                                    </tr>                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($form->detalleDebe as $detalle)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle['cuenta'] }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle['monto'] }}
                                                            </td>
                                                            <td>
                                                                <button wire:click='eliminarCuentaDebe({{ $loop->iteration }})' type="button" class="btn btn-danger">
                                                                    <i class="mdi mdi-trash-can"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div>
                                                @error('form.detalleDebe') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-4">
                                                Haber
                                            </div>
                                            <div class="col-5">
                                            </div>
                                            <div class="col-3">
                                                {{ Illuminate\Support\Number::currency($totalHaber, in: 'S/.', locale: 'en') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModalCuenta" wire:click='agregarHaber'>
                                                <i class="mdi mdi-plus">Agregar Cuenta Contable</i>
                                            </button>
                                            <hr>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Cuenta Contable</th>
                                                        <th>Monto</th>
                                                        <th>Accion</th>
                                                    </tr>                                                    
                                                </thead>
                                                <tbody>
                                                    @foreach ($form->detalleHaber as $detalle)
                                                        <tr>
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle['cuenta'] }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle['monto'] }}
                                                            </td>
                                                            <td>
                                                                <button wire:click='eliminarCuentaHaber({{ $loop->iteration }})' type="button" class="btn btn-danger">
                                                                    <i class="mdi mdi-trash-can"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div>
                                                @error('form.detalleHaber') <span class="error">{{ $message }}</span> @enderror
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
    <!-- Default Modals -->
    <div wire:ignore.self class="modal fade" id="myModalCuenta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloCuenta }}</h5>
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
                            <label for="cuenta_id" class="col-form-label">Cuenta:</label>
                            <select class="js-example-basic-single" id="cuenta_id" name="state" wire:model='dform.cuenta_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($cuentas as $cuenta)
                                    <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('dform.cuenta_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="number" class="form-control" id="monto" wire:model='dform.monto'>
                            <div>
                                @error('dform.monto') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>                                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardarCuenta'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @script()
        <script>
            $('#cuenta_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModalCuenta'
            });
            $('#cuenta_id').on('change',function(){
                let a = document.getElementById("cuenta_id").value;
                $wire.set('dform.cuenta_id',a);
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
