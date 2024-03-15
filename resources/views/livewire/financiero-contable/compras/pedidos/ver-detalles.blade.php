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
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Solicitante <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.tipoDocumento" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            <option value="1" wire:key="1">DOCUMENTO NACIONAL DE IDENTIDAD</option>   
                                            <option value="4" wire:key="4">CARNET DE EXTRANJERÍA</option>    
                                            <option value="6" wire:key="6">REGISTRO UNICO DE CONTRIBUYENTES</option>    
                                            <option value="7" wire:key="7">PASAPORTE</option>    
                                            <option value="A" wire:key="A">CÉDULA DIPLOMATICA DE IDENTIDAD</option>    
                                            <option value="B" wire:key="B">DOC.IDENT.PAIS.RESIDENCIA-NO.D</option>    
                                            <option value="C" wire:key="C">TAX IDENTIFICATION NUMBER - TIN – DOC TRIB PP.NN</option>    
                                            <option value="D" wire:key="D">IDENTIFICATION NUMBER - IN – DOC TRIB PP. JJ</option>    
                                            <option value="E" wire:key="E">TAM- TARJETA ANDINA DE MIGRCIÓN</option>    
                                            <option value="F" wire:key="F">PERMISO TEMPORAL DE PERMANENCIA - PTP</option>    
                                        </select>
                                        @error('state.tipoDocumento')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Moneda <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.tipoDocumento" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            <option value="1" wire:key="1">SOLES</option>
                                        </select>
                                        @error('state.tipoDocumento')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Observaciones</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">ITEMS</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="card-header bg-light">
                                <div class="row" style="padding: 10px 20px;">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Item</label>
                                            <select wire:model="prod.item_id" class="form-select form-select-sm">
                                                <option value="0">Seleccione</option>
                                                @if($itemss)
                                                    @foreach($itemss as $item)
                                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Partida de Control</label>
                                            <select wire:model="prod.partida" class="form-select form-select-sm">
                                                <option value="0">Seleccione</option>
                                                @if($partidas)
                                                    @foreach($partidas as $partida)
                                                        <option value="{{$partida->id}}">{{$partida->id.'-'.$partida->descripcion}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Cantidad</label>
                                            <input type="number" wire:model="prod.cantidad" class="form-control form-control-sm text-center">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mt-4 text-center">
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-info btn-sm" wire:click="aniadir">+ Añadir Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-nowrap table-striped-columns mb-4">
                                                    <thead>
                                                        <tr>
                                                            @if($ver == 3)
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    <i class="fa fa-hourglass-half"></i><br>
                                                                    <input wire:model="todo" wire:click="toggleAll" value="1" name="todo" class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:!border-warning checked:bg-warning hover:!border-warning focus:!border-warning dark:border-navy-400" type="radio">
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    <i class="fa fa-check"></i><br>
                                                                    <input wire:model="todo" wire:click="toggleAll" value="2" name="todo" class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:!border-success checked:bg-success hover:!border-success focus:!border-success dark:border-navy-400" type="radio">
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    <i class="fa fa-ban"></i><br>
                                                                    <input wire:model="todo" wire:click="toggleAll" value="3" name="todo" class="form-radio is-basic h-5 w-5 rounded-full border-slate-400/70 checked:!border-error checked:bg-error hover:!border-error focus:!border-error dark:border-navy-400" type="radio">
                                                                </th>
                                                            @else
                                                                <th
                                                                    style="width:5px"
                                                                    
                                                                >
                                                                    Estado
                                                                </th>
                                                                @endif
                                                                <th
                                                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                                >
                                                                    Item
                                                                </th>
                                                                <th
                                                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                                >
                                                                    Partida
                                                                </th>
                                                            @if($ver == 2)
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    Solicita
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    En Almacen
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    Stock Actual
                                                                </th>
                                                                <th
                                                                    style="width:120px"
                                                                >
                                                                    Aceptado
                                                                </th>
                                                            @else
                                                                <th
                                                                    style="width:120px"
                                                                >
                                                                    Solicitado
                                                                </th>
                                                                @if($ver == 2 || $ver == 3)
                                                                    <th
                                                                        style="width:120px"
                                                                    >
                                                                        Aceptado
                                                                    </th>
                                                                    @endif
                                                            @endif
                                                            <th
                                                                style="width:5px"
                                                            >
                                                                Medida
                                                            </th>
                                                            @if($ver==4 || $ver==1)
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    Acciones
                                                                </th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($items)>0)
                                                            @foreach($items as $item)
                                                                <tr style="background-color: @if($item['compra_id']) #cbd5e1 @elseif(!$item['tpp']) #cffbd5 @elseif($item['eliminar']) #ffe0dd @endif" class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                                    @if($ver == 3)
                                                                        @if($item['compra_id'])
                                                                            <td colspan="3">
                                                                                <div class="badge rounded border border-success text-success">
                                                                                    Aprobado
                                                                                </div>
                                                                                <br>
                                                                                <i><b>Compra Generada [{{$item['correlativo']}}]</b></i>
                                                                            </td>
                                                                        @else
                                                                            <td>
                                                                                <label class="inline-flex items-center space-x-2">
                                                                                    <input wire:model="ap.{{$item['id']}}" value="1" name="ap{{$item['id']}}" class="form-radio mt-2 is-basic h-5 w-5 rounded-full border-slate-400/70 checked:!border-warning checked:bg-warning hover:!border-warning focus:!border-warning dark:border-navy-400" type="radio">
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <label class="inline-flex items-center space-x-2">
                                                                                    <input wire:model="ap.{{$item['id']}}" value="2" name="ap{{$item['id']}}" class="form-radio mt-2 is-basic h-5 w-5 rounded-full border-slate-400/70 checked:border-success checked:bg-success hover:border-success focus:border-success dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent" type="radio">
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <label class="inline-flex items-center space-x-2">
                                                                                    <input wire:model="ap.{{$item['id']}}" value="3" name="ap{{$item['id']}}" class="form-radio mt-2 is-basic h-5 w-5 rounded-full border-slate-400/70 checked:!border-error checked:bg-error hover:!border-error focus:!border-error dark:border-navy-400" type="radio">
                                                                                </label>
                                                                            </td>     
                                                                        @endif
                                                                    @else
                                                                        <?php
                                                                            if($ver == 2){
                                                                                if($ap[$item['id']] == 1){
                                                                                    $nombre = 'Pendiente';
                                                                                    $color = 'warnig';
                                                                                }elseif($ap[$item['id']] == 2){
                                                                                    $nombre = 'Aprobado';
                                                                                    $color = 'success';
                                                                                }elseif($ap[$item['id']] == 3){
                                                                                    $nombre = 'Rechazado';
                                                                                    $color = 'error';
                                                                                }
                                                                            }else{
                                                                                $nombre = 'Pedido';
                                                                                $color = 'info';
                                                                            }
                                                                        ?>
                                                                        <td class="text-center">
                                                                            <div class="badge rounded border border-{{$color}} text-{{$color}}">
                                                                                {{$nombre}}
                                                                            </div>
                                                                            
                                                                            @if($item['compra_id'])
                                                                                <br>
                                                                                <i><b style="color:green">Compra Generada [{{$item['correlativo']}}]</b></i>
                                                                            @elseif(!$item['tpp'])
                                                                                <br>
                                                                                <i><b style="color:green">Se añadira</b></i>
                                                                            @elseif($item['eliminar'])
                                                                            <br>
                                                                                <i><b style="color:red">Se Eliminara</b></i>
                                                                            @endif
                                                                        </td>
                                                                    @endif    
                                                                    <td>{{$item['nom']}}</td>
                                                                    <td></td>
                                                                    @if($ver == 2)
                                                                        <td class="text-center ">
                                                                            {{$item['cantidad']}}
                                                                        </td>
                                                                        <td class="text-center ">
                                                                            <?php
                                                                                if($item['en_almacen']>0){
                                                                                    $t1 = 'success';
                                                                                }else{
                                                                                    $t1 = 'error';
                                                                                }
                                                                            ?>
                                                                            <div class="badge rounded border border-{{$t1}} text-{{$t1}}">
                                                                                {{$item['en_almacen']}}
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center ">
                                                                            <?php
                                                                                $comp = $item['en_almacen']-$item['cantidad'];
                                                                                if($comp<0){
                                                                                    $comp = 0;
                                                                                    $t1 = 'error';
                                                                                }else{
                                                                                    $t1 = 'success';
                                                                                }
                                                                            ?>
                                                                            <div class="badge rounded border border-{{$t1}} text-{{$t1}}">
                                                                                {{$comp}}
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center ">
                                                                            <label class="inline-flex items-center space-x-2">
                                                                                <input wire:model.lazy="cant.apro.{{$item['id']}}" @if($ver != 3) disabled @endif  type="number" class="text-center form-input w-full h-8 rounded border border-slate-300 bg-transparent px-3 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                                            </label>
                                                                        </td>
                                                                    @else
                                                                        <td class="text-center">
                                                                            {{$item['cantidad']}}
                                                                        </td>
                                                            
                                                                            @if($ver == 3 || $ver == 2)
                                                                                <td class="text-center ">
                                                                                    <label class="inline-flex items-center space-x-2">
                                                                                        <input wire:model.lazy="cant.apro.{{$item['id']}}" @if($ver != 3) disabled @endif  type="number" class="text-center form-input w-full h-8 rounded border border-slate-300 bg-transparent px-3 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                                                    </label>
                                                                                </td>
                                                                            @endif
                                                                    
                                                                    @endif
                                                                    <td class="text-center ">
                                                                        {{$item['medida']}}
                                                                    </td>
                                                                    
                                                                    @if(($ver == 4 || $ver == 1) && !$item['compra_id'] && !$item['eliminar'])
                                                                    <td class="text-center ">
                                                                        @if($item['estado'] == 1)
                                                                        <button wire:click="editarItem({{$item['id']}})" class="btn btn-info btn-sm">
                                                                            <i class="bx bx-edit-alt"></i>
                                                                        </button>
                                                                        @endif
                                                                        <button @click="$dispatch('eliminarItem', [{{$item['id']}}, {{$item['tpp']}}])" class="btn btn-danger btn-sm">
                                                                            <i class="bx bx-trash"></i>
                                                                        </button>
                                                                    </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                                <td colspan="6" class=" text-center"><i>No hay items agregados</i></td>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:click="guardar">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
