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
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Año Academico</th>
                                <th scope="col">Fecha </th>
                                <th scope="col">Fuente Financiamiento </th>
                                <th scope="col">Monto Inicial</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cajas as $caja)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            {{ $caja->descripcion }}
                                        </td>
                                        <td>
                                            {{ optional(optional($caja)->año_academico)->descripcion }}
                                        </td>
                                        <td>
                                            @if(optional($caja)->fecha_creacion != null)
                                                {{ Carbon\Carbon::parse($caja->fecha_creacion)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $caja->nFuenteFinanciamiento }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($caja->monto_inicial, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($caja->estado == 1)
                                                <span class="badge bg-success">{{ $caja->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $caja->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($caja->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $caja->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $caja->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $caja->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $cajas->links() }}
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
                            <div class="mb-3 col-12"> 
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <input type="text" class="form-control" placeholder="Descripcion del caja" id="descripcion" wire:model='form.descripcion'>
                                <div>
                                    @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="fecha" class="col-form-label">Fecha de Creacion</label>
                                <input type="date" class="form-control" id="fecha" wire:model='form.fecha_creacion'>
                                <div>
                                    @error('form.fecha_creacion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="tipo" class="col-form-label">Año Academico:</label>
                                <select class="form-control" id="tipo" name="state" wire:model.live='form.año_academico_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach($años_academicos as $año)
                                    <option value="{{ $año->id }}">{{ $año->descripcion }}</option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('form.año_academico_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 mt-2 col-6" wire:ignore>
                                <label for="responsable_id" class="form-label">Responsable:</label>
                                <select {{ $deshabilitar }} class="js-example-basic-single" id="responsable_id" wire:model='form.responsable_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($responsables as $responsable)
                                        <option value="{{ $responsable->id }}">{{ $responsable->nombres }} {{ $responsable->apellidoPaterno }} {{ $responsable->apellidoMaterno }}</option>
                                    @endforeach
                                </select>
                            </div>            
                            <div>
                                @error('form.responsable_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 col-3">
                                <label for="tipo" class="col-form-label">Fuente Financiamiento:</label>
                                <select class="form-control" id="tipo" name="state" wire:model.live='form.fuente_financiamiento'>
                                    <option value="">Seleccionar Opcion</option>
                                    <option value="1">Recursos Directamente Recaudados</option>
                                </select>
                                <div>
                                    @error('form.año_academico_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 mt-2 col-3">
                                <label for="monto_inicial" class="form-label">Monto:</label>
                                <input type="number" class="form-control" placeholder="Monto" id="monto_inicial" wire:model='form.monto_inicial'>
                                <div>
                                    @error('form.monto_inicial') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>                                                  
                            <div class="mb-3 col-3 mt-2">
                                <label for="decreto" class="form-label">N° Decreto:</label>
                                <input type="text" class="form-control" placeholder="Decreto" id="decreto" wire:model='form.decreto'>
                                <div>
                                    @error('form.decreto') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div> 
                            <div class="col-12 mb-5">
                                <label for="nro_requerimiento" class="col-form-label">Decreto:</label>
                                <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
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
