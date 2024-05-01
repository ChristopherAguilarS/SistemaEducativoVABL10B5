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
                                <div class="col-lg-4">
                                    <b>Tipo de Movimiento:</b>
                                    <select wire:model="tipoMov" @if($ver == 2 || $ver == 3) disabled @endif class="form-select form-select-sm">
                                        <option value="1">Ingreso por Compra</option>
                                        <option value="3">Ingreso por Orden de Compra (unitaria)</option>
                                        <option value="2">Ingreso por Orden de Compra (multiple)</option>
                                    </select>
                                    @error('tipoMov')
                                        <small style="color:red">(*) Obligatorio</small>
                                    @enderror 
                                </div>
                                <div class="col-lg-2">
                                    <b>Código:</b>
                                    <div class="relative flex -space-x-px">
                                        <input type="text" disabled  placeholder="Buscar..." wire:model.defer="codProy" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <b>Proyecto:</b>
                                    <div class="relative flex">
                                        <input wire:model="nomProy" type="text" disabled="" class="form-control form-control-sm">
                                    </div>
                                    @error('state.local_id')
                                        <small style="color:red">(*) Obligatorio</small>
                                    @enderror
                                </div>
                                @if($moneda_id == 2)
                                    <div class="col-lg-2">
                                        <b>Fecha T.C:</b>
                                        <input wire:model="tipo_cambio_fecha" disabled type="date" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-lg-2">
                                        <b>Tipo de Cambio:</b>
                                        <input wire:model="tipo_cambio" type="text" class="text-right form-control">
                                        @error('tipo_cambio')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror 
                                    </div>    
                                @else
                                    <div class="col-lg-4"></div>
                                @endif
                                
                                <div class="col-lg-2">
                                    @if($tipoMov == 1)
                                    <b>Moneda:</b>
                                    <div class="lex -space-x-px">
                                        <div class="mt-1.5 flex -space-x-px">
                                            <select wire:model="moneda_id" @if($ver == 2) disabled @endif class="form-select form-select-sm">
                                                <option value="0">seleccione</option>
                                                @if(!is_null($monedas))
                                                    @foreach($monedas as $moneda)
                                                        <option value="{{$moneda['id']}}">{{$moneda['nombre']}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            
                                        </div>
                                        @error('moneda_id')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                    </div>
                                    @elseif($tipoMov == 3)
                                    <div class="col-span-12 lg:col-span-4">
                                        <b>Cuotas:</b>
                                        <select wire:model="cuotas" @if($ver == 2) disabled @endif class="form-select form-select-sm">
                                            <option value="0">No</option>
                                            <option value="1">1 Cuota</option>
                                            <option value="2">2 Cuotas</option>
                                            <option value="3">3 Cuotas</option>
                                            <option value="4">4 Cuotas</option>
                                        </select>
                                    </div>
                                    @endif 
                                </div>
                                <div class="col-lg-6">
                                    <b>Proveedor:</b>
                                    <div class="lex -space-x-px">
                                        <div class="mt-1.5 flex -space-x-px">
                                            <input wire:model="nomProv" @if($ver == 2 || $ordenes) disabled @else readonly @endif wire:click="$emit('buscarProveedor')" placeholder="Click para buscar proveedor" class="form-control form-control-sm" placeholder="Username" type="text">
                                            <button wire:click="brProv" @if($ver == 2 || $ordenes) disabled @endif class="form-control form-control-sm">
                                                <i class="fa fa-remove"></i> 
                                            </button>
                                            <button wire:click="$emit('nuevoProveedor', 0, 2)" @if($ver == 2 || $ordenes) disabled @endif class="flex items-center justify-center rounded-r-lg border border-slate-300 bg-info  text-white px-3.5 font-inter dark:border-navy-450">
                                                <i class="fa fa-plus"></i> 
                                            </button>
                                        </div>
                                        @if($ordenes)   
                                            <center><small>Para Cambiar el proveedor debe quitar las ordenes.</small></center>
                                        @endif
                                    </div>
                                    @error('state.proveedor_id')
                                        <small style="color:red">(*) Obligatorio</small>
                                    @enderror
                                </div>
                            </div>
                            @if($tipoMov == 1)
                                <div class="grid grid-cols-12 gap-4 sm:gap-5">
                                    <label class="col-span-12 lg:col-span-4">
                                        <b>Tipo de Comprobante:</b>
                                        <select @if($ver == 2) disabled @endif wire:model="comp.catalogo_comprobantes_compra_id" class="h-8 form-select mt-1.5 w-full rounded border border-slate-300 bg-white px-3  hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($tipos))
                                                @foreach($tipos as $tipo)
                                                    <option value="{{$tipo['id']}}">{{$tipo['descripcion']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('comp.catalogo_comprobantes_compra_id')
                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                        @enderror 
                                    </label>
                                    <label class="col-span-12 lg:col-span-2">
                                        <b>Serie:</b>
                                        <input @if($ver == 2) disabled @endif wire:model="comp.serie" type="text" class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                        
                                    </label>
                                    <label class="col-span-12 lg:col-span-3">
                                        <b>Correlativo:</b>
                                        <input @if($ver == 2) disabled @endif wire:model="comp.correlativo" type="number" class="mt-1 text-right form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                        
                                    </label>
                                    <label class="col-span-12 lg:col-span-3">
                                        <b>Forma de Pago:</b>
                                        <select @if($ver == 2) disabled @endif wire:model="comp.catalogo_forma_pago_id" class="h-8 form-select mt-1 w-full rounded border border-slate-300 px-3  hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($formas))
                                                @foreach($formas as $tipo)
                                                    <option value="{{$tipo['id']}}">{{$tipo['descripcion']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('comp.catalogo_forma_pago_id')
                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                        @enderror 
                                    </label>
                                    <label class="col-span-12 lg:col-span-2">
                                        <b>Valor del IGV:</b>
                                        <select @if($ver == 2) disabled @endif wire:model="comp.porcentaje_igv" class="h-8 form-select mt-1 w-full rounded border border-slate-300 px-3  hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option value="0">Sin IGV</option>
                                            <option value="8">8%</option>
                                            <option value="10">10%</option>
                                            <option value="18">18%</option>
                                        </select>
                                        @error('comp.porcentaje_igv')
                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                        @enderror 
                                        
                                    </label>
                                    <label class="col-span-12 lg:col-span-2">
                                        <b>Fecha Emisión:</b>
                                        <input @if($ver == 2) disabled @endif wire:model="comp.fecha_emision" type="date" class="mt-1 form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                        @error('comp.fecha_emision')
                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                        @enderror
                                    </label>
                                    <label class="col-span-12 lg:col-span-2">
                                        <b>Fecha Vencimiento:</b>
                                        <input @if($ver == 2) disabled @endif wire:model="comp.fecha_vencimiento" type="date" class="mt-1 form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                        @error('comp.fecha_vencimiento')
                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                        @enderror
                                    </label>
                                    <label class="col-span-12 lg:col-span-6">
                                        <b>Detracción:</b>
                                        <select @if($ver == 2) disabled @endif wire:model="comp.catalogo_detraccion_id" class="h-8 form-select mt-1 w-full rounded border border-slate-300 px-3  hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option value="0">No Aplica</option>
                                            @if(!is_null($detracciones))
                                                @foreach($detracciones as $detraccion)
                                                    <option value="{{$detraccion['id']}}">{{'('.($detraccion['porcentaje']*100).'%) '.$detraccion['codigo'].' - '.$detraccion['descripcion']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </div>
                            @else
                                <div class="grid grid-cols-12 gap-4 sm:gap-5">
                                    <label class="col-span-12 lg:col-span-12">
                                        <h3 class="text-base font-medium text-slate-600 dark:text-navy-100">
                                            <b>COMPROBANTE(S) ASOCIADO(S) ---</b> <br><hr>
                                        </h3>
                                    </label>
                                    @if($ver == 3 || $ver == 1)
                                        <label class="col-span-12 lg:col-span-12 text-center">
                                            <button wire:click="$emit('bComp', '{{$state['proveedor_id']}}', {{count($ordenes)}})" class="mt-1 h-8 btn rounded rounded  bg-warning font-medium text-white hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                <i class="fa fa-search"></i> &nbsp;&nbsp;Buscar Comprobante
                                            </button>
                                            <button wire:click="$emit('vCompTemp', 0, {{$almacen_id}}, {{$ver}}, '{{$state['proveedor_id']}}')" class="mt-1 h-8 btn rounded rounded  bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                <i class="fa fa-plus"></i> &nbsp;&nbsp;Añadir Comprobante
                                            </button>
                                        </label>
                                    @endif
                                    <label class="col-span-12 lg:col-span-12 text-center">
                                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                            <table class="text-xs w-full text-left">
                                                <thead>
                                                <tr class="text-xs border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                        <th
                                                            style="width: 10px;"
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Nro.
                                                        </th>
                                                        <th
                                                            style="width: 10px;"
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Tipo
                                                        </th>
                                                        <th
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Numeración
                                                        </th>
                                                        <th
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Detracción
                                                        </th>
                                                        <th
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Forma de Pago
                                                        </th>
                                                        <th
                                                            style="width: 10px;"
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Fecha
                                                        </th>
                                                        <th
                                                            style="width: 10px;"
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Moneda
                                                        </th>
                                                        <th
                                                            style="width: 10px;"
                                                            class="text-center whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Total
                                                        </th>
                                                        @if($ver == 3 || $ver == 1)
                                                        <th
                                                            style="width: 10px;"
                                                            class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Acc
                                                        </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!is_null($comprobantes) && count($comprobantes)>0)
                                                        @foreach ($comprobantes as $data)
                                                            <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500" style="background-color: @if($data['temp']) #cffbd5 @elseif($data['eliminar']) #ffe0dd @endif">
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                                                                    {{$loop->iteration}}
                                                                    @if($data['temp'])
                                                                        <br>
                                                                        <i><b style="color:green">Se añadira</b></i>
                                                                    @elseif($data['eliminar'])
                                                                        <br>
                                                                        <i><b style="color:red">Se Eliminara</b></i>
                                                                    @elseif($data['agregar'])
                                                                        <br>
                                                                        <i><b style="color:#0b72d7">En el Sistema</b></i>
                                                                    @endif
                                                                </td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">{{$data['tipo']}}</td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                                                                    @if($data['correlativo'])
                                                                        {{$data['serie']}}-{{$data['correlativo']}}
                                                                    @else
                                                                        <b><i>N/E</i></b>
                                                                    @endif
                                                                </td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">{{$data['detracc']?$data['detracc']:'No Aplica'}}</td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">{{$data['forma']}}</td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                                                                    @if($data['fecha_emision'])
                                                                        {{date('d/m/Y', strtotime($data['fecha_emision']))}}
                                                                    @else
                                                                        <b><i>N/E</i></b>
                                                                    @endif
                                                                </td>
                                                                <td class="text-center whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    <b>{{$data['moneda']}}</b>
                                                                </td>
                                                                <td class="text-right whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    {{$data['simbolo'].'.'.number_format($data['total'], 2)}}
                                                                </td>
                                                                @if($ver == 3 || $ver == 1)
                                                                    <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5">
                                                                        @if($ver == 1)
                                                                            <button wire:click="$emit('vCompTemp', {{$data['id']}}, 0, {{$ver}})" class="btn h-6 rounded bg-info px-3 text-xs font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>
                                                                        @else($ver == 3)
                                                                            <button wire:click="editCompTemp({{$data['id']}})" class="btn h-6 rounded bg-info px-3 text-xs font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>
                                                                        @endif
                                                                        <button wire:click="$emit('delComp', {{$data['id']}},{{$ver}}, {{$data['eliminar']}})" class="btn h-6 rounded bg-error px-3 text-xs font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                            @if($data['eliminar'])    
                                                                                <i class="fa fa-ban"></i>
                                                                            @else
                                                                                <i class="fa fa-trash"></i>
                                                                            @endif
                                                                        </button>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                            <td colspan="7" class="text-right text-center whitespace-nowrap px-4 py-3 sm:px-5"><b>TOTAL</b></td>
                                                            <td class="text-right text-center whitespace-nowrap px-4 py-3 sm:px-5"><b style="color: @if($comp['total'] != $total_comp) red @else green @endif">{{$data['simbolo'].'.'.number_format($total_comp, 2)}}</b></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td colspan="8"><br>
                                                                <b><center><i>Sin Comprobantes Ingresados</i></center></b>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </label>
                                </div>
                                @if($cuotas)
                                <hr>
                                <label class="col-span-12 lg:col-span-12 text-center">
                                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                        <table class="is-hoverable w-full text-left text-xs">
                                            <thead>
                                                <tr>
                                                    <th style="width:5px" class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                        
                                                    </th>
                                                    <th class="text-center whitespace-nowrap bg-slate-200 px-4 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                        Cuota1
                                                    </th>
                                                    <th class="text-center whitespace-nowrap bg-slate-200 px-4 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                        Cuota2
                                                    </th>
                                                    <th class="text-center whitespace-nowrap bg-slate-200 px-4 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                        Cuota3
                                                    </th>
                                                    <th class="text-center whitespace-nowrap bg-slate-200 px-4 py-2 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                                        Cuota4
                                                    </th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:5px" class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <b>FECHA</b>
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="date" wire:model.lazy="ccuotas.f1" @if($ver == 2) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.f1')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="date" wire:model.lazy="ccuotas.f2" @if($ver == 2) disabled @endif @if($cuotas < 2) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.f2')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="date" wire:model.lazy="ccuotas.f3" @if($ver == 2) disabled @endif @if($cuotas < 3) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.f3')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="date" wire:model.lazy="ccuotas.f4" @if($ver == 2) disabled @endif @if($cuotas < 4) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.f4')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:5px" class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <b>MONTO</b>
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="number" wire:model.lazy="ccuotas.m1"@if($ver == 2) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.m1')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="number" wire:model.lazy="ccuotas.m2"@if($ver == 2) disabled @endif @if($cuotas < 2) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.m2')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="number" wire:model.lazy="ccuotas.m3"@if($ver == 2) disabled @endif @if($cuotas < 3) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.m3')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                    <td class="whitespace-nowrap px-4 py-1 sm:px-5">
                                                        <input type="number" wire:model.lazy="ccuotas.m4"@if($ver == 2) disabled @endif @if($cuotas < 4) disabled @endif class="mt-1 text-center form-input h-8 w-full rounded border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary disabled:pointer-events-none disabled:select-none disabled:border-none disabled:bg-zinc-100 dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent dark:disabled:bg-navy-600">
                                                        @error('ccuotas.m4')
                                                            <span class="block text-left text-tiny sm:col-span-12 text-error">Obligatorio (*)</span>
                                                        @enderror 
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </label>
                                @endif
                            @endif
                            <div class="grid grid-cols-12 gap-4 sm:gap-5">
                            
                            @if($tipoMov == 2 || $tipoMov == 3)
                                <label class="col-span-12 lg:col-span-12">
                                    <h3 class="text-base font-medium text-slate-600 dark:text-navy-100">
                                        <b>ORDENES DE COMPRA ---</b> <br><hr>
                                    </h3>
                                </label>
                                @if($ver == 1)
                                <label class="col-span-12 lg:col-span-12 text-center">
                                    <button wire:click="$emit('vCompras', {{$almacen_id}}, {{$idSel}}, {{$state['proveedor_id']}}, {{$moneda_id}})" class="mt-1 h-8 btn rounded rounded  bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                        <i class="fa fa-plus"></i> Añadir O/C - O/C
                                    </button>
                                </label>
                                @endif
                                <label class="col-span-12 lg:col-span-12 text-center">
                                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                        <table class="is-hoverable w-full text-left text-xs">
                                            <thead>
                                                <tr>
                                                    <th
                                                        style="width:5px"
                                                        class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        Pedido
                                                    </th>
                                                    <th
                                                        class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        Solicitante
                                                    </th>
                                                    <th
                                                        class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        Proveedor
                                                    </th>
                                                    <th
                                                        style="width:5px"
                                                        class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        Fecha
                                                    </th>
                                                    <th
                                                        style="width:5px"
                                                        class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        Moneda
                                                    </th>
                                                    
                                                    @if($ver == 1 || $ver == 3)
                                                        <th
                                                            style="width:5px"
                                                            class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                        >
                                                            Acc.
                                                        </th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($ordenes)
                                                    @foreach($ordenes as $orden)
                                                        <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{str_pad($orden['correlativo'], 6, "0", STR_PAD_LEFT)}}</td>                                                   
                                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$orden['solicitante']}}</td>
                                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$orden['idprov']}}-{{$orden['prov']}}</td>
                                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{date('d/m/Y', strtotime($orden['fecha']))}}</td>
                                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                <b>{{$orden['moneda']}}</b>
                                                            </td>
                                                            @if($ver == 1)
                                                                <td class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5">
                                                                    <button wire:click="$emit('delCompraTemp', {{$orden['id']}})" class="btn h-6 rounded bg-error px-3 text-xs font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                        <td colspan="6" class="whitespace-nowrap px-4 py-3 sm:px-5 text-center"><i>No hay ordenes agregados</i></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </label>
                            @endif
                            @if($tipoMov == 1 && $ver == 1)
                            <label class="col-span-12 lg:col-span-12 text-center">
                                <button wire:click="$emit('vItems', 3, {{$idSel}}, {{$tipoMov}}, {{$almacen_id}}, 0, {{$comp['porcentaje_igv']}})" class="mt-1 h-8 btn rounded rounded  bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    <i class="fa fa-plus"></i> Añadir Item
                                </button>
                            </label>
                            @endif
                            <label class="col-span-12 lg:col-span-12 text-center">
                                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                    <table class="is-hoverable w-full text-left text-xs">
                                        <thead>
                                            <tr>
                                                <th
                                                    style="width:5px"
                                                    class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    #
                                                </th>
                                                @if($tipoMov==2)
                                                    <th
                                                        style="width:5px"
                                                        class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        Compra
                                                    </th>
                                                @endif
                                                <th
                                                    style="width:5px"
                                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    COD
                                                </th>
                                                <th
                                                    class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    Item
                                                </th>
                                                <th
                                                    style="width:5px"
                                                    class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    Cantidad
                                                </th>
                                                <th
                                                    style="width:5px"
                                                    class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    TOTAL
                                                </th>
                                                @if($tipoMov==1)
                                                <th
                                                    style="width:5px"
                                                    class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    IGV
                                                </th>
                                                @endif
                                                @if($categoria_id==3 && ($tipoMov == 2 || $tipoMov == 3))
                                                <th
                                                    style ="width:10px" class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    Info
                                                </th>
                                                @endif
                                                @if($tipoMov==2)
                                                <th
                                                    class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                >
                                                    Comprobante
                                                </th>
                                                @endif
                                                
                                                @if($tipoMov == 1 && ($ver == 1 || $ver == 3))
                                                    <th
                                                        style="width:5px"
                                                        class="text-center whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        
                                                    </th>
                                                    <th
                                                        style="width:5px"
                                                        class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                                    >
                                                        
                                                    </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($items)>0)
                                                <?php $c=0; ?>
                                                @foreach($items as $item)
                                                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                        <td class="text-center whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5">
                                                            {{$loop->iteration}}
                                                        </td>
                                                        
                                                        @if($tipoMov==2)
                                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{str_pad($item['idc'], 6, "0", STR_PAD_LEFT)}}</td>
                                                        @endif
                                                        <td class="text-center whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5">
                                                            {{str_pad($item['idItem'], 6, "0", STR_PAD_LEFT)}}
                                                        </td>
                                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{$item['nom']}}</td>
                                                        <td class="text-center whitespace-nowrap px-4 py-3 sm:px-5">
                                                            {{$item['cant']}}
                                                        </td>
                                                        <td class="text-right whitespace-nowrap px-4 py-3 sm:px-5">
                                                        {{$item['simbolo']}}.{{number_format($item['com_par_con_igv'], 2)}}
                                                        </td>
                                                        @if($tipoMov==1)
                                                        <td class="text-right whitespace-nowrap px-4 py-3 sm:px-5">
                                                            <?php
                                                                if($comp['porcentaje_igv'] == $item['porcentaje_igv']){
                                                                    $col = '';
                                                                }else{
                                                                    $c++;
                                                                    $col = 'red';
                                                                }
                                                                if ($item['porcentaje_igv']===null) {
                                                                    $text = 'N/E';
                                                                }else{
                                                                    $text = number_format($item['porcentaje_igv'], 2).'%';
                                                                }
                                                            ?>              
                                                            <font style="color:{{$col}}">
                                                                {{$text}}
                                                            </font>
                                                        </td>
                                                        @endif
                                                        @if($categoria_id==3 && ($tipoMov == 2 || $tipoMov == 3))
                                                            <td class="text-center whitespace-nowrap px-4 py-3 sm:px-5">
                                                                @if($item['info'])
                                                                    <button wire:click="$emit('vItems', 3, {{$item['info_id']}}, {{$tipoMov}}, {{$almacen_id}}, 0, {{$comp['porcentaje_igv']}})" class="btn h-6 rounded bg-info px-3 text-xs font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                        <i class="fa fa-check"></i>
                                                                    </button>
                                                                @else
                                                                    <button wire:click="$emit('vItems', 3, {{$item['info_id']}}, {{$tipoMov}}, {{$almacen_id}}, 0, {{$comp['porcentaje_igv']}})" class="btn h-6 rounded bg-error px-3 text-xs font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        @endif
                                                        @if($tipoMov ==2)
                                                            <td class="text-center whitespace-nowrap px-4 py-3 sm:px-5">
                                                                <select @if($ver == 2) disabled @else readonly @endif wire:model="arr.{{$item['id']}}" class="h-8 form-select mt-1.5 w-full rounded border border-slate-300 bg-white px-3  hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                                    <option value="0">Seleccione</option>
                                                                    @if(!is_null($comprobantes))
                                                                        @foreach($comprobantes as $comprobante)
                                                                            <option value="{{$comprobante['id']}}">{{$comprobante['serie'].'-'.$comprobante['correlativo']}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </td>
                                                        @endif
                                                        @if(($tipoMov == 1) && ($ver == 1 || $ver == 3))
                                                            <td class="whitespace-nowrap text-center rounded-r-lg px-4 py-3 sm:px-5">
                                                                @if($almacen_tipo == 3)
                                                                    <button wire:click="$emit('vItems', 3, {{$item['id']}}, {{$tipoMov}}, {{$almacen_id}}, 0, {{$comp['porcentaje_igv']}})" class="btn h-6 rounded bg-info px-3 text-xs font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                @else
                                                                    <button wire:click="editRecurso({{$item['id']}})" class="btn h-6 rounded bg-info px-3 text-xs font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            @if($ver == 1)
                                                                <td class="whitespace-nowrap text-center rounded-r-lg px-4 py-3 sm:px-5">
                                                                    <button wire:click="$emit('delItemTemp', {{$item['id']}}, {{$tipoMov}})" class="btn h-6 rounded bg-error px-3 text-xs font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                    <td colspan="<?php if($tipoMov == 3){echo 3;}else{echo 4;}?>" class="text-right whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5">
                                                        <b>Total</b>
                                                    </td>
                                                    <td class="text-right whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5">
                                                        <b>{{number_format($comp['total'], 2)}}</b>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @else
                                                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                    <td colspan="7" class="whitespace-nowrap px-4 py-3 sm:px-5 text-center"><i>No hay items agregados</i></td>
                                                </tr>
                                            @endif
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </label>
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
