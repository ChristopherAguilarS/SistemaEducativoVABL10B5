<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-12">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Datos Personales | Los campos con (*) son obligatorios.</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Apellidos y Nombres del Gestor de la Compra:<font style="color:red">(*)</font></label>
                                        <select class="form-select form-select-sm" wire:model.defer="state.trabajador_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            @if($gestores)
                                                @foreach($gestores as $trabajador)
                                                    <option value="{{$trabajador->id}}">{{$trabajador->dni.'-'.$trabajador->nombres.' '.$trabajador->apellidoPaterno.', '.$trabajador->apellidoMaterno}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.trabajador_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Proveedor:<font style="color:red">(*)</font></label>
                                        <select class="form-select form-select-sm" wire:model.live="state.proveedor_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            @if($proveedores)
                                                @foreach($proveedores as $proveedor)
                                                    <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.proveedor_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Fecha <font style="color:red">(*)</font></label>
                                        <input type="date" wire:model="state.fecha" class="form-control form-control-sm">
                                        @error('state.fecha')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Fecha Entrega<font style="color:red">(*)</font></label>
                                        <input type="date" wire:model="state.fecha_entrega" class="form-control form-control-sm">
                                        @error('state.fecha_entrega')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Forma de Pago <font style="color:red">(*)</font></label>
                                        <select class="form-select form-select-sm" wire:model="state.forma_pago_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            @foreach($formas as $forma)
                                                <option value="{{$forma['id']}}">{{$forma['descripcion']}}</option>
                                            @endforeach
                                        </select>
                                        @error('state.forma_pago_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-<?php if($state['moneda_id'] == 2){echo '2';}else{echo '4';}?>">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Moneda <font style="color:red">(*)</font></label>
                                        <select class="form-select form-select-sm" wire:model="state.moneda_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            @foreach($monedas as $moneda)
                                                <option value="{{$moneda['id']}}">{{$moneda['nombre']}}</option>
                                            @endforeach
                                        </select>
                                        @error('state.moneda_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                @if($state['moneda_id'] == 2)
                                    <div class="col-lg-4">
                                        <b>T.C:</b>
                                        <input type="text" wire:model="state.tipo_cambio" class="form-control form-control-sm">
                                        @error('state.tipo_cambio')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Lugar de Entrega</label>
                                        <textarea class="form-control form-control-sm" wire:model="state.lugar_entrega" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Observaciones</label>
                                        <textarea class="form-control form-control-sm" wire:model="state.observaciones" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                            @if($ver != 3)
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Ordenes de Compra/Servicio</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="card-header bg-light">
                                <div class="row" style="padding: 10px 20px;">
                                    <div class="col-lg-10">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Compra/Servicio</label>
                                            <select wire:model="pedido_id" class="form-select form-select-sm">
                                                <option value="0">Seleccione</option>
                                                @if($pedidos_pend)
                                                    @foreach($pedidos_pend as $pend)
                                                        <option value="{{$pend->id}}">{{str_pad($pend->correlativo, 6, "0", STR_PAD_LEFT)}} - {{$pend->solicitante}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('pedido_id')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mt-4 text-center">
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-info btn-sm" wire:click="selPedido">+ Añadir</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <table class="table table-hover align-middle table-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width:5px">Cód</th>
                                                    <th>Solicitante</th>
                                                    @if($ver == 1 || $ver == 4)
                                                        <th style="width:5px">Acc.</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($pedidos)>0)
                                                    @foreach($pedidos as $item)
                                                        <tr>
                                                            <td>{{str_pad($item['correlativo'], 6, "0", STR_PAD_LEFT)}}</td>                                                   
                                                            <td>{{$item['solicitante']}}</td>
                                                            @if($ver == 1 || $ver == 4)
                                                                <td>
                                                                    <button wire:click="delPedido({{$item['id']}})" class="btn btn-danger btn-sm">
                                                                        <i class="bx bx-trash"></i>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="6"><i>No hay pedidos agregados</i></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div>
                            @endif
                            <h6 class="mt-4" style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Listado de Items</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-hover align-middle table-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5px" rowspan="2">Cód</th>
                                                            <th style="width:5px" rowspan="2">Pedido</th>
                                                            <th rowspan="2">Item</th>
                                                            <th style="width:5px" rowspan="2">Cantidad</th>
                                                            <th style="width:5px" rowspan="2">Medida</th>
                                                            <th style="width:120px" colspan="3">Precio Unitario</th>
                                                            <th style="width:120px" colspan="2">Parcial</th>
                                                            <th style="width:5px" rowspan="2">Tipo</th>
                                                            @if($ver == 1 || $ver == 4)
                                                                <th style="width:5px" rowspan="2">Acc.</th>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th style="width:120px">SIN IGV</th>
                                                            <th style="width:5px">IGV</th>
                                                            <th style="width:120px">Con IGV</th>
                                                            <th style="width:120px">Sin IGV</th>
                                                            <th style="width:120px">Con IGV</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($items)>0)
                                                        <?php $tt1 = 0; $tt2 = 0; ?>
                                                        @foreach($items as $item)
                                                            <tr style="background-color: @if(!$item['tpp']) #cffbd5 @elseif($item['eliminar']) #ffe0dd @endif"> 
                                                                <td>
                                                                    {{str_pad($item['idpd'], 6, "0", STR_PAD_LEFT)}}
                                                                    @if(!$item['tpp'])
                                                                        <br>
                                                                        <i><b style="color:green">Se añadira</b></i>
                                                                    @elseif($item['eliminar'])
                                                                        <br>
                                                                        <i><b style="color:red">Se Eliminara</b></i>
                                                                    @endif
                                                                </td>  
                                                                <td>{{str_pad($item['correlativo'], 6, "0", STR_PAD_LEFT)}}</td>                                                       
                                                                <td>{{$item['nom']}}</td>
                                                                <td>
                                                                    <button wire:click="$emit('editarCantidad',{{$item['id']}}, {{$almacen_tipo}}, {{$ver}})" class="btn btn-info btn-sm">
                                                                        {{$item['mod_cant']?$item['mod_cant']:$item['cant']}} {{$item['mod_cant']?'(pend: '.($item['cant']-$item['mod_cant']).')':''}}
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    {{$item['medida']}}
                                                                </td>
                                                                <td>
                                                                
                                                                    {{$mon.number_format($item['com_sin_igv'], 2)}}
                                                                </td>
                                                                <td>
                                                                    {{$item['com_igv']?'si':'no'}}
                                                                </td>
                                                                <td>
                                                                    {{$mon.number_format($item['com_con_igv'], 2)}}
                                                                </td>
                                                                <td>
                                                                <?php $tt1+=$item['com_par_sin_igv'];?>
                                                                    {{$mon.number_format($item['com_par_sin_igv'], 2)}}
                                                                </td>
                                                                <td>
                                                                <?php $tt2+=$item['com_par_con_igv'];?>
                                                                    {{$mon.number_format($item['com_par_con_igv'], 2)}}
                                                                </td>
                                                                <td>
                                                                    @if($item['tipo_seleccion'] == 1)
                                                                        <span class="badge bg-info">
                                                                            Pedido
                                                                        </span>
                                                                    @elseif($item['tipo_seleccion'] == 2)
                                                                        <span class="badge bg-success">
                                                                            Recurso
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                @if($ver == 1 || $ver == 4)
                                                                <td>
                                                                    <button wire:click="editarItem({{$item['id']}})" class="btn btn-info btn-sm">
                                                                        <i class="bx bx-edit-alt"></i>
                                                                    </button>
                                                                    @if(($ver == 1 || $ver == 4) && !$item['eliminar'] && $item['tipo_seleccion'] == 2)
                                                                        <button wire:click="delRecurso({{$item['id']}}, {{$item['tpp']}})" class="btn btn-danger btn-sm">
                                                                            <i class="bx bx-trash"></i>
                                                                        </button>
                                                                    @endif
                                                                </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="5"><b>TOTAL</b></td>
                                                            <td><b></b></td>
                                                            <td></td>
                                                            <td><b></b></td>
                                                            <td><b>{{$mon.number_format($tt1, 2)}}</b></td>
                                                            <td><b>{{$mon.number_format($tt2, 2)}}</b></td>
                                                        </tr>
                                                    @else
                                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                            <td colspan="13"><i>No hay pedidos agregados</i></td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                        if($ver == 3){
                            if($estado == 2){
                                $icon = 'ban';
                                $fun = 'desaprobar';
                                $nom = 'Desaprobar';
                                $color = 'error';
                            }else{
                                $icon = 'check';
                                $fun = 'aprobar2';
                                $nom = 'Aprobar';
                                $color = 'info';
                            }
                        }else{
                            $icon = 'save';
                            $fun = 'guardar';
                            $nom = 'Guardar';
                            $color = 'info';
                        }
                    ?>
                    <button type="button" class="@if($ver==2) hidden @endif btn btn-{{$color}} " wire:click="{{$fun}}" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="{{$fun}}" style="display:none"></span>
                        <i class="bx bx-{{$icon}}" wire:loading.remove="" wire:target="{{$fun}}"></i>
                        {{$nom}}
                    </button>

                    <button type="button" class="@if($estado!=2) hidden @endif btn btn-info " wire:click="$emit('verArchivo', {{$idSel}})" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none"></span>
                        <i class="bx bx-print" wire:loading.remove="" wire:target="guardar"></i>
                        Imprimir
                    </button>

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
