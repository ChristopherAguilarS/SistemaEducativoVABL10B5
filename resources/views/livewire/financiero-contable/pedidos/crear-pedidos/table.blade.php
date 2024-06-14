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
                                <th scope="col">N° Pedido</th>
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
                                            {{ optional(optional($requerimiento)->pedido)->codigo }}
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
                                            @if($requerimiento->estado_proceso == 3)
                                                <span class="badge bg-success">{{ $requerimiento->nEstadoProcesoPedido }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $requerimiento->nEstadoProcesoPedido }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='abrirRequerimiento({{ $requerimiento->id }})'>Crear Pedido <i class="las la-edit"></i></button>
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
                    <h5 class="modal-title" id="myModalLabel">CREAR PEDIDO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div>
                            @if($indicadorP != null)
                            <h5 class="col-form-label">Objetivo Estrategico:</h5> {{ optional(optional(optional(optional($indicadorP)->actividad_operativa)->accion_estrategica_priorizada)->objetivo_estrategico)->descripcion }} <br>
                            <h5 class="col-form-label">Actividad Operativo:</h5> {{ optional(optional($indicadorP)->actividad_operativa)->descripcion }} <br>
                            <h5 class="col-form-label">Indicador:</h5>  {{ optional($indicadorP)->descripcion }} <br>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripcion:</label>
                            <input disabled type="text" class="form-control" id="descripcion" wire:model='form.descripcion'>
                            <div>
                                @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="fecha" class="col-form-label">Fecha:</label>
                                <input disabled type="date" class="form-control" id="fecha" wire:model='form.fecha'>
                                <div>
                                    @error('form.fecha') <span class="error">{{ $message }}</span> @enderror
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
                            <div class="mb-3 col-6">
                                <div class="mb-3" wire:ignore>
                                    <label for="proveedor_id" class="col-form-label">Proveedor:</label>
                                    <select class="js-example-basic-single" id="proveedor_id" name="state" wire:model='form.proveedor_id'>
                                        <option value="">Seleccionar Opcion</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    @error('form.proveedor_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <hr>                            
                            <label for="tipo" class="col-form-label">ITEMS</label>
                            <div class="mb-3">
                                <div class="card-body">
                                    
                                    <div class="table-responsive table-card">
                                        <table class="table table-striped-columns mb-4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N°</th>
                                                    <th scope="col">Bien</th>
                                                    <th scope="col">Cant. Aprobada</th>
                                                    <th scope="col">Cant. Presupuestada</th>
                                                    <th scope="col">P.U.</th>
                                                    <th scope="col">Importe</th>
                                                    <th scope="col">Observaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bienes as $bien)
                                                    <tr>                                                                    
                                                        <td class="font-medium">
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $this->mostrarCodigo($bien['item_id']) }} - {{ $this->mostrarDescripcion($bien['item_id']) }} - {{ $this->mostrarUnidad($bien['item_id']) }}
                                                        </td>                                                        
                                                        <td style="width: 100px">
                                                            {{ $bien['cantidad_solicitada'] }}
                                                        </td>
                                                        <td style="width: 100px">
                                                            <input type="number" class="form-control" id="cantidad" wire:model='bienes.{{ $loop->index }}.cantidad_presupuestada' max="{{ $bien['cantidad_presupuestada'] }}">
                                                        </td>
                                                        <td style="width: 100px">
                                                            <input type="number" class="form-control" id="cantidad" wire:model='bienes.{{ $loop->index }}.precio'>
                                                        </td>
                                                        <td style="width: 100px">
                                                            <input disabled type="number" class="form-control" id="cantidad" wire:model='bienes.{{ $loop->index }}.importe'>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="comentarios" wire:model='bienes.{{ $loop->index }}.observaciones'>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModalDetalle" wire:click='abrirCaracteristica({{ $requerimiento->id }})'> <i class="las la-check"></i>Agregar Especificacion</button>
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
                            <div class="mb-3">
                                <label for="comentarios" class="col-form-label">Comentarios:</label>
                                <textarea class="form-control" id="comentarios" rows="3" placeholder="Comentarios" wire:model='form.comentarios'></textarea>
                                <div>
                                    @error('form.comentarios') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                             
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='aprobarRequerimiento'>Aprobar</button>
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
                            <div class="mb-3">
                                <label for="tipo" class="col-form-label">Tipo de Caracteristica:</label>
                                <select class="form-control" id="tipo" name="state" wire:model.live='formDetalle.tipo_caracteristica'>
                                    <option value="">Seleccionar Opcion</option>
                                    <option value="1">Marca</option>
                                    <option value="2">Modelo</option>
                                    <option value="3">Color</option>
                                    <option value="4">Tipo</option>
                                    <option value="5">Dimensiones</option>
                                    <option value="6">Peso</option>
                                    <option value="7">Material</option>
                                    <option value="8">Otros</option>
                                </select>
                                <div>
                                    @error('form.tipo_caracteristica') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="col-form-label">Descripcion:</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="descripcion" wire:model='formDetalle.descripcion'></textarea>
                                <div>
                                    @error('formDetalle.descripcion') <span class="error">{{ $message }}</span> @enderror
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
            $('#proveedor_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#proveedor_id').on('change',function(){
                let a = document.getElementById("proveedor_id").value;
                $wire.set('form.proveedor_id',a);
                $wire.actualizarIndicador();
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#proveedor_id').val(event.id);
                $('#proveedor_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#proveedor_id').val(null).trigger('change');
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
