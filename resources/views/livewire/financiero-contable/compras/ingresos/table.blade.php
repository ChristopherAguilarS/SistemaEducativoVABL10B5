
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-nowrap table-striped-columns mb-4">
                        <thead>
                            <tr class="text-xs border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <th style="width: 10px;">Nro.</th>
                                <th>Proveedor</th>
                                <th style="width: 10px;">Fecha</th>
                                <th style="width: 10px;">Total</th>
                                <th style="width: 10px;">Aprobación</th>
                                <th style="width: 10px;">Ingreso</th>
                                <th style="width: 10px;">Acc</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $data)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">{{str_pad($data->correlativo, 6, "0", STR_PAD_LEFT)}}</td>
                                    <td class="px-4 py-3 sm:px-5">
                                        @if($data->proveedor)
                                            {{$data->proveedor}}
                                        @else
                                            <b style="color:red"><i>No Especificado</i></b>
                                        @endif
                                        
                                    </td>
                                    <td>{{date('d/m/Y', strtotime($data->fecha))}}</td>
                                    <td><b>{{$data->simbolo.'.'.number_format($data->total, 2)}}</b></td>
                                    <td>
                                        <?php 
                                            if($data->estado == 1){
                                                $text = 'Pendiente';
                                                $tp='warning';
                                            }elseif($data->estado == 2){
                                                $text = 'Aprobado';
                                                $tp='success';
                                            }
                                        ?>
                                        <div class="text-xs badge bg-{{$tp}} text-white">{{$text}}</div>
                                    </td>
                                    <td>
                                        <?php 
                                            if($data->ingreso){
                                                $text = date('d/m/Y', strtotime($data->fech_ingreso));
                                                $tp='success';
                                            }else{
                                                $text = 'Pendiente';
                                                $tp='warning';
                                            }
                                        ?>
                                        <div class="text-xs badge bg-{{$tp}} text-white">{{$text}}</div>
                                    </td>
                                    <td>
                                        <div class="btn-group material-shadow">
                                            <button class="btn btn-primary btn-sm dropdown-toggle material-shadow-none" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ...
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item cursor-pointer" wire:click="$dispatch('nuevo', [{{$data->id}}, {{$data->almacen_id}}, 2])">Ver</a>
                                                <a class="dropdown-item cursor-pointer" wire:click="$dispatch('nuevo', [{{$data->id}}, {{$data->almacen_id}}, 3])">Aprobar</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item cursor-pointer" wire:click="$dispatch('nuevo', [{{$data->id}}, {{$data->almacen_id}}, 4])">Editar</a>
                                                @if($data->estado == 2)
                                                    <a class="dropdown-item cursor-pointer" wire:click="$dispatch('verArchivo', [{{$data->id}}])">Imprimir</a>
                                                @endif
                                                <a class="dropdown-item cursor-pointer" wire:click="$dispatch('delCompra', [{{$data->id}}])">Eliminar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
