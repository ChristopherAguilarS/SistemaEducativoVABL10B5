<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width:5px" scope="col">Cód</th>
                                    <th style="width:5px" scope="col">QR</th>
                                    <th scope="col">Equipo/Bien</th>
                                    <th style="width:5px" class="text-center" scope="col">Trabajador</th>
                                    <th style="width:5px" class="text-center" scope="col">Observaciones</th>
                                    <th style="width:5px" class="text-center" scope="col">Estado</th>
                                    <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $documento)
                                        <tr>                
                                            <td class="font-medium align-middle">
                                                {{ $documento->CODIGO_ACTIVO?$documento->CODIGO_ACTIVO:'E'.str_pad($documento->Id, 11, "0", STR_PAD_LEFT) }}
                                            </td>
                                            <td class="align-middle">
                                                {{$documento->id}} 
                                            </td>
                                            <td class="align-middle">
                                                {{ ucwords(strtolower($documento->DESCRIPCION)) }} 
                                            </td>
                                            <td class="align-middle">
                                                {{ $documento->ApellidoPaterno?$documento->trabajador:'No Asignado' }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $documento->OBSERVACIONES }}
                                            </td>
                                            <td class="align-middle" style="text-align:center">
                                                <?php 
                                                    if($documento->ESTADO_CONSERV==1){
                                                        ?><span class="badge badge-info" style="color:white">Bueno</span><?php
                                                    }elseif($documento->ESTADO_CONSERV==2){
                                                        ?><span class="badge badge-primary">Regular</span><?php
                                                    }elseif($documento->ESTADO_CONSERV==3){
                                                        ?><span class="badge badge-warning">Malo</span><?php
                                                    }elseif($documento->ESTADO_CONSERV==4){
                                                        ?><span class="badge badge-danger">Muy Malo</span><?php
                                                    }elseif($documento->ESTADO_CONSERV==5){
                                                        ?><span class="badge badge-success">Nuevo</span><?php
                                                    }elseif($documento->ESTADO_CONSERV==6){
                                                        ?><span class="badge badge-secondary">Chatarra</span><?php
                                                    }elseif($documento->ESTADO_CONSERV==7){
                                                        ?><span class="badge badge-light">RAEE</span><?php
                                                    }
                                                ?>
                                            </td>
                                            
                                            <td class="text-center align-middle"> 
                                                <button type="button" @click="$dispatch('verEquipamiento', [{{ $documento->id }} ])" class="btn btn-info btn-sm"><i class="ri-contacts-book-line"></i> Editar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4"><center>Sin Información</center></td>
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
