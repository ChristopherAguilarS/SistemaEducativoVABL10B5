<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card p-3" wire:loading.class="opacity-50">
                        <small>Click en el codigo para ver el detalle del Equipo</small>
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width:5px" scope="col">Cód</th>
                                    <th style="width:5px" scope="col">QR</th>
                                    <th scope="col">Equipo/Bien</th>
                                    <th class="text-center" scope="col">Trabajador</th>
                                    <th class="text-center" scope="col">Ambiente</th>
                                    <th style="width:5px" class="text-center" scope="col">Estado</th>
                                    <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $documento)
                                        <tr>                
                                            <td class="font-medium" style="vertical-align:middle">
                                                <button type="button" @click="$dispatch('nuevoIngreso', [{{ $documento->id }}, 3])" class="btn btn-ghost-primary waves-effect waves-light material-shadow-none">
                                                    {{ $documento->CODIGO_ACTIVO?$documento->CODIGO_ACTIVO:'E'.str_pad($documento->Id, 11, "0", STR_PAD_LEFT) }}
                                                </button>
                                            </td>
                                            <td style="vertical-align:middle">
                                                {{$documento->id}} 
                                            </td>
                                            <td style="vertical-align:middle">
                                                {{ ucwords(strtolower($documento->DESCRIPCION)) }} 
                                            </td>
                                            <td style="vertical-align:middle">
                                                {{ $documento->trabajador?$documento->trabajador:'No Asignado' }}
                                            </td>
                                            <td style="vertical-align:middle">
                                                {{ $documento->ambiente }}
                                            </td>
                                            <td style="vertical-align:middle" style="text-align:center">
                                                <?php 
                                                    if($documento->ESTADO_CONSERV==1){
                                                        ?><h4><span class="badge bg-info" style="color:white">Bueno</span></h4><?php
                                                    }elseif($documento->ESTADO_CONSERV==2){
                                                        ?><h4><span class="badge bg-primary">Regular</span></h4><?php
                                                    }elseif($documento->ESTADO_CONSERV==3){
                                                        ?><h4><span class="badge bg-warning">Malo</span></h4><?php
                                                    }elseif($documento->ESTADO_CONSERV==4){
                                                        ?><h4><span class="badge bg-danger">Muy Malo</span></h4><?php
                                                    }elseif($documento->ESTADO_CONSERV==5){
                                                        ?><h4><span class="badge bg-success">Nuevo</span></h4><?php
                                                    }elseif($documento->ESTADO_CONSERV==6){
                                                        ?><h4><span class="badge bg-secondary">Chatarra</span></h4><?php
                                                    }elseif($documento->ESTADO_CONSERV==7){
                                                        ?><h4><span class="badge bg-light">RAEE</span></h4><?php
                                                    }
                                                ?>
                                            </td>
                                            <td style="vertical-align:middle">
                                                @if(!$documento->inventariado)
                                                    <button type="button" @click="$dispatch('inventa', [{{$documento->id}}])" class="btn btn-warning btn-sm"><i class="ri-contacts-book-line"></i> Inventariar</button>
                                                @else
                                                <button type="button" @click="$dispatch('delInv', [{{$documento->inventariado}}, '{{$documento->DESCRIPCION}}'])" class="btn btn-danger btn-sm"><i class=" ri-delete-back-2-line"></i> Eliminar Inv.</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9"><center>Sin Información</center></td>
                                    </tr>
                                @endif
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
</div>
