
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">Nro.</th>
                                    <th style="width: 10px;">Codigo</th>
                                    <th>Denominación</th>
                                    <th>Ubicacion</th>
                                    <th style="width: 10px;">Estado</th>
                                    <th style="width: 10px;">Asig.</th>
                                    <th style="width: 10px;">Det.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($posts->count()>0)
                                    @foreach ($posts as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->CODIGO_ACTIVO}}</td>
                                            <td>{{$data->DESCRIPCION}}</td>
                                            <td>
                                                <?php
                                                    if($data->prestado){
                                                        ?>{{$data->nombres}}<?php
                                                    }else{
                                                        ?>-<?php
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                @if($data->prestado)
                                                    <h4><span class="badge bg-danger">Prestado</span></h4>
                                                @else
                                                    <h4><span style="margin-top:5px" class="badge bg-success">Disponible</span></h4>
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" wire:click="$dispatch('Asignacion', [{{$data->equipo_id}}, '{{$data->CODIGO_ACTIVO}}', '{{$data->DESCRIPCION}}'])" class="btn btn-info"><i class="mdi mdi-account-convert-outline"></i></button>
                                            </td>
                                            <td>
                                                <button type="button" wire:click="$dispatch('ver', [{{$data->id}}, '{{$data->denominacion}}'])" class="btn btn-primary"><i class="mdi mdi-badge-account-horizontal"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="7"><center><i><b>Sin Equipos Disponibles</b></i></center></td>
                                </tr>
                                @endif
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
