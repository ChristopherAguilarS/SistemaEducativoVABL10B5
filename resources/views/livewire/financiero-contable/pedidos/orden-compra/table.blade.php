<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Requerimientos</h4>
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
                                <th scope="col">N° Requerimiento</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requerimientos as $requerimiento)
                                    <tr>                
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>                                        
                                        <td>
                                            {{ $requerimiento->nro_requerimiento }}
                                        </td>
                                        <td>
                                            {{ $requerimiento->descripcion }}
                                        </td>
                                        <td>
                                            @if(optional($requerimiento)->fecha_registro_requerimiento != null)
                                                {{ Carbon\Carbon::parse($requerimiento->fecha_registro_requerimiento)->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $requerimiento->nTipoPedido }}
                                        </td>
                                        <td>
                                            @if($requerimiento->estado == 1)
                                                <span class="badge bg-success">{{ $requerimiento->nEstado }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $requerimiento->nEstado }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($requerimiento->estado == 1)
                                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $requerimiento->id }})'>Dar de Baja <i class="ri-thumb-down-line align-bottom me-1"></i></button>
                                            
                                            @else
                                                <button type="button" class="btn btn-success bg-gradient waves-effect waves-light" wire:click='cambiarEstado({{ $requerimiento->id }})'>Dar de Alta <i class="ri-thumb-up-line align-bottom me-1"></i></button>
                                            @endif
                                                <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='editar({{ $requerimiento->id }})'>Editar <i class="las la-edit"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $requerimientos->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!-- Default Modals -->
    <div wire:ignore.self id="myModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row"> 
                            <div class="mb-3" wire:ignore>
                                <label for="indicador_id" class="col-form-label">Indicador:</label>
                                <select class="js-example-basic-single" id="indicador_id" name="state" wire:model='form.indicador_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($indicadores as $indicador)
                                        <option value="{{ $indicador->id }}">{{ $indicador->codigo }} - {{ $indicador->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            @if($indicadorP != null)
                            <h5 class="col-form-label">Objetivo Estrategico:</h5> {{ optional(optional(optional(optional($indicadorP)->actividad_operativa)->accion_estrategica_priorizada)->objetivo_estrategico)->descripcion }} <br>
                            <h5 class="col-form-label">Actividad Operativo:</h5> {{ optional(optional($indicadorP)->actividad_operativa)->descripcion }} <br>
                            <h5 class="col-form-label">Indicador:</h5>  {{ optional($indicadorP)->descripcion }} <br>
                            @endif
                        </div>
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
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="fecha" class="col-form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" wire:model='form.fecha_registro_requerimiento'>
                                <div>
                                    @error('form.fecha_registro_requerimiento') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="tipo" class="col-form-label">Tipo de Requerimiento:</label>
                                <select class="form-control" id="tipo" name="state" wire:model.live='form.tipo_pedido'>
                                    <option value="">Seleccionar Opcion</option>
                                    <option value="1">Bien</option>
                                    <option value="2">Servicio</option>
                                </select>
                                <div>
                                    @error('form.tipo_pedido') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-6" wire:ignore>
                                <label for="responsable_id" class="col-form-label">Responsable:</label>
                                <select class="js-example-basic-single" id="responsable_id" name="state" wire:model='formDetalle.responsable_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($responsables as $responsable)
                                        <option value="{{ $responsable->id }}">{{ $responsable->nombres }} {{ $responsable->apellidoPaterno }} {{ $responsable->apellidoMaterno }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                @error('form.responsable_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <hr>                            
                            <label for="tipo" class="col-form-label">ITEMS</label>
                            <div class="mb-3">
                                <div class="card-header mb-5" style="text-align: right">
                                    <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModalDetalle" ><i class="las la-plus"></i>Agregar Item</button></td>
                                </div>
                                <div class="card-body">
                                    
                                    <div class="table-responsive table-card">
                                        <table class="table table-striped-columns mb-4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N°</th>
                                                    <th scope="col">Codigo</th>
                                                    <th scope="col">Bien</th>
                                                    <th scope="col">Unidad</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bienes as $bien)
                                                    <tr>                                                                    
                                                        <td class="font-medium">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $this->mostrarCodigo($bien['item_id']) }}
                                                        </td>
                                                        <td>
                                                            {{ $this->mostrarDescripcion($bien['item_id']) }}
                                                        </td>
                                                        <td>
                                                            {{ $this->mostrarUnidad($bien['item_id']) }}
                                                        </td>
                                                        <td>
                                                            {{ $bien['cantidad'] }}
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger rounded-pill bg-gradient waves-effect waves-light btn-sm me-2" wire:click='eliminarItem'><i class="las la-trash"></i></button></td>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-none code-view">
                                        
                                    </div>
                                </div><!-- end card-body -->
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
    <div wire:ignore.self id="myModalDetalle" data-bs-backdrop="static" data-bs-keyboard="false" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloDetalle }}</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="mb-3" wire:ignore>
                                <label for="item_id" class="col-form-label">Item:</label>
                                <select class="js-example-basic-single" id="item_id" name="state" wire:model='formDetalle.item_id'>
                                    <option value="">Seleccionar Opcion</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->familia->clase->grupo->codigo.'.'.$item->familia->clase->codigo.'.'.$item->familia->codigo.'.'.$item->codigo }} - {{ $item->descripcion }} - {{ $item->unidad_medida->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                @error('formDetalle.item') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cantidad" class="col-form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" wire:model='formDetalle.cantidad'>
                                <div>
                                    @error('formDetalle.cantidad') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="especificaciones" class="col-form-label">Especificaciones:</label>
                                <textarea class="form-control" id="especificaciones" rows="3" placeholder="Especificaciones" wire:model='formDetalle.especificaciones'></textarea>
                                <div>
                                    @error('formDetalle.especificaciones') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#myModal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardarDetalle'>Guardar</button>
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
                $wire.actualizarIndicador();
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#indicador_id').val(event.id);
                $('#indicador_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#indicador_id').val(null).trigger('change');
            });
            $('#item_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModalDetalle'
            });
            $('#item_id').on('change',function(){
                let a = document.getElementById("item_id").value;
                $wire.set('formDetalle.item_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#item_id').val(event.id);
                $('#item_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#item_id').val(null).trigger('change');
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
