<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-8">
                        <form action="#" class="form-steps" autocomplete="off">
                            <div class="step-arrow-nav mb-4">
                                <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true" data-position="0">
                                            Contratos
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false" data-position="1" tabindex="-1">
                                            Meritos
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false" data-position="2" tabindex="-1">
                                            Demeritos
                                        </button>
                                    </li>   
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="table-responsive table-card">
                                    <table class="table table-nowrap table-striped-columns mb-4">
                                        <thead>
                                            <tr>
                                                <th style="width:5px" scope="col">N°</th>
                                                <th style="width:5px" scope="col">Nro. Doc</th>
                                                <th scope="col">Apellidos y Nombres</th>
                                                <th style="width:5px" class="text-center" scope="col">Area de Trabajo</th>
                                                <th style="width:5px" class="text-center" scope="col">Inicio</th>
                                                <th style="width:5px" scope="col" class="text-center">Acciones</th>
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
                                                            {{ date('d/m/Y', strtotime($especifica->fecha_inicio)) }} 
                                                        </td>
                                                        <td class="text-center align-middle"> 
                                                            <button type="button" @click="$dispatch('ver', [{{ $especifica->id }}])" class="btn btn-info btn-sm"><i class="ri-contacts-book-line"></i> Ver</button>
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
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-4">

                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
