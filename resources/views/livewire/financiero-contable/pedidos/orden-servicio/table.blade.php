<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Orden de Servicios</h4>
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
                                <th scope="col">N° Pedido</th>
                                <th scope="col">N° OS</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="!text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($requerimientos as $requerimiento)
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
                                @endforeach --}}
                                <tr>
                                    <td>1</td>
                                    <td>P0001</td>
                                    <td>OS001</td>
                                    <td>05/06/2024</td>
                                    <td>
                                        <span class="badge bg-danger">Pendiente</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info bg-gradient waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Crear OS <i class="las la-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="d-flex justify-content-end mt-2">
                        {{ $requerimientos->links() }}
                    </div> --}}
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
                    <h5 class="modal-title" id="myModalLabel">Crear Orden de Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row"> 
                            <div>
                                <!--[if BLOCK]><![endif]-->                            <h5 class="col-form-label">Objetivo Estrategico:</h5> Modernizar la gestión de la escuela por procesos y resultados, con
    centralidad en los estudiantes, a través de la actualización e implementación de los instrumentos de gestión en el marco de una
    cultura institucional de trabajo colegiado, participativa e identidad. <br>
                                <h5 class="col-form-label">Actividad Operativo:</h5> Actualización de los instrumentos de gestión institucional acorde con la RVM 097- 2022-MINEDU con fines de licenciamiento. <br>
                                <h5 class="col-form-label">Indicador:</h5>  Número de instrumentos de gestión institucional  actualizados y aprobados con RD acorde con la normatividad vigente y las Condiciones Básicas de Calidad (CBC). <br>
                                 <!--[if ENDBLOCK]><![endif]-->
                            </div>
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
                            <input type="text" class="form-control" id="descripcion" value="Orden de Servicio de Prueba">
                            <div>
                                @error('form.descripcion') <span class="error"></span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="fecha" class="col-form-label">Fecha Inicio:</label>
                                <input type="date" class="form-control" id="fecha" wire:model='form.fecha_registro_requerimiento'>
                                <div>
                                    @error('form.fecha_registro_requerimiento') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-4" wire:ignore="">
                                <label for="responsable" class="col-form-label">Responsable:</label>
                                <input disabled="" type="text" class="form-control" id="responsable"value="JOSE PEREZ ROJAS">
                            </div>
                            <div class="mb-3 col-4" wire:ignore="">
                                <label for="responsable" class="col-form-label">Proveedor:</label>
                                <input disabled="" type="text" class="form-control" id="responsable"value="JUAN FLOREZ RAMIREZ">
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
                                                    <th scope="col">Cant. Solicitada</th>
                                                    <th scope="col">Cant. Entregada</th>
                                                    <th scope="col">P.U.</th>
                                                    <th scope="col">IMPORTE</th>
                                                    <th scope="col">Observaciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tbody>
                                                    <!--[if BLOCK]><![endif]-->                                                    <tr>                                                                    
                                                            <td class="font-medium">
                                                                1
                                                            </td>
                                                            <td>
                                                                &nbsp;02.05.0001.0010 - SERVICIO ESPECIALIZADO DE SISTEMAS
                                                            </td>                                                        
                                                            <td style="width: 100px">
                                                                1
                                                            </td>
                                                            <td style="width: 100px">
                                                                1
                                                            </td>
                                                            <td style="width: 100px">
                                                                <input type="number" class="form-control" id="cantidad" value="2000" >
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" id="cantidad" value="2000">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="cantidad">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                SUBTOTAL
                                                            </td>
                                                            <td>
                                                                S/. 20000
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                IGV
                                                            </td>
                                                            <td>
                                                                S/. 3600
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                TOTAL
                                                            </td>
                                                            <td>
                                                                S/. 23600
                                                            </td>
                                                        </tr>
                                                     <!--[if ENDBLOCK]><![endif]-->
                                                </tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-none code-view">
                                        
                                    </div>
                                </div><!-- end card-body -->
                            </div>
                            <div class="mb-3 col-3">
                                <label for="fecha" class="col-form-label">Fecha de Fin:</label>
                                <input type="date" class="form-control" id="fecha">
                                <div>
                                    @error('form.fecha_registro_requerimiento') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-9">
                                <label for="descripcion" class="col-form-label">Lugar de Entrega:</label>
                                <input type="text" class="form-control" id="descripcion" value="">
                                <div>
                                    @error('form.descripcion') <span class="error"></span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="descripcion" class="col-form-label">Condiciones de Pago:</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion"></textarea>
                                <div>
                                    @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="descripcion" class="col-form-label">Terminos y Condiciones:</label>
                                <textarea class="form-control" id="descripcion" rows="3" placeholder="Descripcion"></textarea>
                                <div>
                                    @error('form.descripcion') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                             
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click='guardar'>Crear</button>
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
