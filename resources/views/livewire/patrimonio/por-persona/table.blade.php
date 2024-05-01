<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap table-striped-columns mb-4">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="width:5px" scope="col">N°</th>
                                    <th rowspan="2" style="width:5px" scope="col">Nro. Doc</th>
                                    <th rowspan="2" scope="col">Apellidos y Nombres</th>
                                    <th rowspan="2" style="width:5px" class="text-center" scope="col">Area de Trabajo</th>
                                    <th rowspan="2" style="width:5px" class="text-center" scope="col">Año</th>
                                    <th colspan="3" style="width:5px" class="text-center" scope="col">Equipamiento</th>
                                    <th style="width:5px" scope="col" class="text-center">Acciones</th>
                                </tr>
                                <tr>
                                    <th style="width:5px">Inventariado</th>
                                    <th style="width:5px">Pendiente</th>
                                    <th style="width:5px">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($especificas->count()>0)
                                    @foreach ($especificas as $especifica)
                                        <tr>                
                                            <td class="font-medium align-middle">
                                                {{ $loop->iteration}}
                                            </td>
                                            <td class="align-middle">
                                                {{ $especifica->dni }}
                                            </td>
                                            <td class="align-middle">
                                                {{ $especifica->nombres }} 
                                                <br>  
                                                @if($especifica->catalogo_tipo_trabajador_id == 1)
                                                    <span style="margin-top:5px" class="badge bg-success">Docente</span>
                                                @else
                                                    <span class="badge bg-danger">Administrativo</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                {{ $especifica->area }} 
                                            </td>
                                            <td class="align-middle">
                                               {{$SelAnio}} 
                                            </td>
                                            <td class="align-middle" style="text-align:center">
                                                <h4><span class="badge bg-<?php if($especifica->inventariados){echo 'info';}else{echo 'danger';} ?>">
                                                    {{ $especifica->inventariados }}
                                                </span></h4>
                                                
                                            </td>
                                            <td class="align-middle" style="text-align:center">
                                                <h4><span class="badge bg-<?php if($especifica->pendientes){echo 'warning';}else{echo 'light';} ?> text-black">
                                                    {{ $especifica->pendientes }}
                                                </span></h4>
                                                
                                            </td>
                                            <td class="align-middle" style="text-align:center">
                                                <b>{{ $especifica->pendientes + $especifica->inventariados }}</b>
                                            </td>
                                            <td class="text-center align-middle"> 
                                                <button type="button" @click="$dispatch('verEquipamiento', [{{ $especifica->id }}, {{$SelAnio}} ])" class="btn btn-info btn-sm"><i class="ri-contacts-book-line"></i> Ver</button>
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
                        {{ $especificas->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
</div>
