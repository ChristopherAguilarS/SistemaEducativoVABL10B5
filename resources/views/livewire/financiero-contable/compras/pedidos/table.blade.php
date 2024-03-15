
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th
                                        rowspan="2"
                                        style="width: 10px;"
                                    >
                                        Nro.
                                    </th>
                                    <th
                                        rowspan="2"
                                        style="width:5px"
                                    >
                                        Tipo
                                    </th>
                                    <th
                                        rowspan="2"
                                    >
                                        Solicitante
                                    </th>
                                    <th
                                        style="width: 10px;"
                                        rowspan="2"
                                    >
                                        Fecha
                                    </th>
                                    <th
                                        rowspan="2"
                                    >
                                        Hora
                                    </th>
                                    <th
                                        style="width: 10px;"
                                        rowspan="2"
                                    >
                                        Revisión
                                    </th>
                                    <th
                                        colspan="3"
                                    >
                                        Items
                                    </th>
                                    <th
                                        rowspan="2"
                                        style="width: 10px;"
                                    >
                                        Acc
                                    </th>
                                </tr>
                                <tr>
                                    <th
                                        style="width: 10px;"
                                    >
                                        <i class="fa fa-hourglass-half text-sm"></i>
                                    </th>
                                    <th
                                        style="width: 10px;"
                                    >
                                        <i class="fa fa-check text-sm"></i>
                                    </th>
                                    <th
                                        style="width: 10px;"
                                    >
                                        <i class="fa fa-ban text-sm"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $data)
                                    <tr>
                                        <td>{{str_pad($data->correlativo, 6, "0", STR_PAD_LEFT)}}</td>
                                        <td>
                                            <?php
                                                if($data->tipo_id == 1){
                                                    echo 'COMPRA';
                                                }else{
                                                    echo 'TRASLADO';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            {{$data->nombre_completo }}
                                        </td>
                                        <td>
                                            {{date('d/m/Y', strtotime($data->created_at))}}
                                        </td>
                                        <td>
                                            {{date('h:i a', strtotime($data->created_at))}}
                                        </td>
                                        <td>
                                            <?php 
                                                if($data->pendientesCount()){
                                                    if($data->aprobadosCount()){
                                                        $text = 'Parcial';
                                                        $tp='warning';
                                                    }else{
                                                        $text = 'Pendiente';
                                                        $tp='error';
                                                    }
                                                }else{
                                                    $text = 'Revisado';
                                                    $tp='success';
                                                } 
                                            ?>
                                            <div class="text-xs badge bg-{{$tp}} text-white">{{$text}}</div>
                                        </td>
                                        <td>
                                            <?php if($data->pendientes){$tp='error';}else{$tp='success';} ?>
                                            <div class="text-xs badge rounded border border-warning text-warning">
                                                {{$data->pendientesCount()}}
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($data->aprobados){$tp='success';}else{$tp='error';} ?>
                                            <div class="text-xs badge rounded border border-success text-success">
                                                {{$data->aprobadosCount()}}
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($data->pendientes){$tp='error';}else{$tp='success';} ?>
                                            <div class="text-xs badge rounded border border-error text-error">
                                                {{$data->rechazadosCount()}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex justify-around space-x-1">
                                                <div x-data="usePopper({placement:'bottom-end',offset:4})" @click.outside="if(isShowPopper) isShowPopper = false" class="inline-flex">
                                                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper" class="btn -mr-1.5 h-7 w-7 shrink-0 rounded-full p-0 text-black hover:bg-white/20 focus:bg-white/20 active:bg-white/25">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                                        </svg>
                                                    </button>
                                                    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper &amp;&amp; 'show'" style="z-index: 10; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(-109px, 406px);" data-popper-placement="bottom-end">
                                                        <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                                            <ul>
                                                                <li>
                                                                    <a style="cursor: pointer;" wire:click="$emit('nuevo', {{$data->id}}, {{$almacen}}, 2)" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ver</a>
                                                                </li>
                                                                <li>
                                                                    <a style="cursor: pointer;" wire:click="$emit('nuevo', {{$data->id}}, {{$almacen}}, 3)" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"><i class="fa fa-check"></i>&nbsp;&nbsp;Revisar</a>
                                                                </li>
                                                            </ul>
                                                            <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>   
                                                            <ul>
                                                                <li>
                                                                    <a style="cursor: pointer;" wire:click="$emit('nuevo', {{$data->id}}, {{$almacen}}, 4)" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"><i class="fa fa-edit"></i>&nbsp;&nbsp;Editar</a>
                                                                </li>
                                                                <li>
                                                                    <a style="cursor: pointer;" wire:click="$emit('eliminarPedido', {{$data->id}}, {{$data->correlativo}})" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100"><i class="fa fa-remove"></i>&nbsp;&nbsp;Eliminar</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $posts->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
