<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Saldo Inicial</h4>
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
                                <th scope="col">Cuenta</th>
                                <th scope="col">Debe</th>
                                <th scope="col">Haber</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($saldos as $saldo)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $saldo->cuenta->codigo }} - {{ $saldo->cuenta->descripcion }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($saldo->saldo_inicial_debe, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($saldo->saldo_inicial_haber, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($saldo->estado == 1)
                                                <span class="badge bg-success">{{ $saldo->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $saldo->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-animation waves-effect waves-light" data-text="Info"><span>Editar</span></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $saldos->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <div wire:ignore.self id="myModal" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="año" class="col-form-label">Año:</label>
                            <select class="form-control" id="año" name="state" wire:model='form.año'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($años as $año)
                                    <option value="{{ $año }}">{{ $año }}</option>    
                                @endforeach
                            </select>
                            <div>
                                @error('form.fecha') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label for="cuenta_id" class="col-form-label">Tipo de Ingreso:</label>
                            <select class="js-example-basic-single" id="cuenta_id" name="state" wire:model='form.cuenta_id'>
                                <option value="">Seleccionar Opcion</option>
                                @foreach ($cuentas as $cuenta)
                                    <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div>
                            @error('form.cuenta_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="saldo_inicial_debe" class="col-form-label">Saldo Inicial Debe:</label>
                                <input type="number" class="form-control" wire:model='form.saldo_inicial_debe'>
                                <div>
                                    @error('form.saldo_inicial_debe') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="saldo_inicial_haber" class="col-form-label">Saldo Inicial Haber:</label>
                                <input type="number" class="form-control" wire:model='form.saldo_inicial_haber'>
                                <div>
                                    @error('form.saldo_inicial_haber') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
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
