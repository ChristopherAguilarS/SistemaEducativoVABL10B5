
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width:5px" scope="col">Cód</th>
                                    <th scope="col">Detalle de Item</th>
                                    <th style="width:5px" scope="col">Medida</th>
                                    @if($tipo_almacen == 1)
                                        <th style="width:5px" scope="col">Stock</th>
                                    @elseif($tipo_almacen == 3 && $tSel!=1)
                                        <th style="width:5px" scope="col">Serie</th>
                                    @endif
                                    <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($posts)>0)
                                    @foreach($posts as $item)
                                        <?php 
                                            if($item->stockActual>0){
                                                $cl = 'success';
                                            }else{
                                                $cl = 'error';
                                            }
                                        ?>
                                        <tr>
                                            <td class="align-middle">
                                                <?php if($tipo_almacen == 1){echo 'HMI';}elseif($tipo_almacen == 2){echo 'SE';}elseif($tipo_almacen == 3){echo 'EQ';}?>-{{$item['id']}}
                                            </td>
                                            <td class="align-middle">
                                                {{$item['nombre']}}
                                            </td>
                                            <td class="align-middle">
                                                {{$item['medida']}}
                                            </td>
                                            @if($tipo_almacen == 1)
                                            <td class="align-middle">
                                                <div class="badge rounded border border-{{$cl}} text-{{$cl}}">
                                                    {{$item->stockActual?$item->stockActual:'0'}}
                                                </div>
                                            </td>
                                            @elseif($tipo_almacen == 3 && $tSel!=1)
                                                <td class="align-middle">
                                                    {{$item->serie}}
                                                </td>
                                            @endif
                                            <td class="align-middle">
                                                <button type="button" @click="$dispatch('selItem', [{{$item->id}}, '{{$item->nombre}}'])" class="btn btn-info btn-sm">
                                                    Seleccion
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><center><i>No encontrado</i></center></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
