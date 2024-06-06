<div>
    <div wire:ignore.self id="form2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h6 style="display: flex; align-items: center;">
                            <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                            <span style="margin-right: 5px;"><b>Trabajador</b></span>
                        </h6>
                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Nro. Documento <font style="color:red">(*)</font></label>
                                        <div class="input-group">
                                            <input type="text" wire:model="numeroDocumento" class="form-control form-control-sm" aria-label="Dollar amount (with dot and two decimal places)">
                                            <span class="cursor-pointer input-group-text" wire:click="buscar"><i class="bx bx-search-alt-2"></i></span>
                                        </div>
                                        @error('numeroDocumento')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Nombres <font style="color:red">(*)</font></label>
                                        <input class="form-control form-control-sm" wire:model.live="nombres" type="text" disabled>
                                        @error('nombres')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-header bg-light">
                                <div class="row" style="padding: 10px 20px;">
                                    <h6 style="display: flex; align-items: center;">
                                        <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                        <span style="margin-right: 5px;"><b>Nuevo Estudio</b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input" >Institución <font style="color:red">(*)</font></label>
                                            <input class="form-control form-control-sm" wire:model.live="state.institucion_nombre" type="text">
                                            @error('state.institucion_nombre')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Estudios <font style="color:red">(*)</font></label>
                                            <select class="form-select form-select-sm" wire:model.live="state.catalogo_tipo_estudio_id">
                                                <option value="0">Seleccione</option>    
                                                <option value="1">Educacion Primaria</option>
                                                <option value="2">Educacion Secundaria</option>
                                                <option value="3">Auxiliar Tecnico</option>
                                                <option value="4">Bachiller</option>
                                                <option value="10">Titulo</option>
                                                <option value="5" style="display:none">Doctorado</option>
                                                <option value="6" style="display:none">Maestria</option>
                                                <option value="7">Profesional Tecnico</option>
                                                <option value="8">Tecnico</option>
                                                <option value="9">Especialidad</option>
                                            </select>
                                            @error('state.catalogo_tipo_estudio_id')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input" >Programa <font style="color:red">(*)</font></label>
                                            <input class="form-control form-control-sm" wire:model.live="state.programa" type="text">
                                            @error('state.programa')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Estado <font style="color:red">(*)</font></label>
                                                <select class="form-select form-select-sm" wire:model.live="state.estado_estudio">
                                                    <option value="0">Seleccione</option>
                                                    <option value="1">Incompleta</option>
                                                    <option value="2">Completa</option>
                                                </select>
                                            @error('state.estado_estudio')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Fech. Emisión <font style="color:red">(*)</font></label>
                                            <input class="form-control form-control-sm" wire:model.live="state.fecha_emision" type="date">
                                            @error('state.fecha_emision')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Fech. Inicio <font style="color:red">(*)</font></label>
                                            <input class="form-control form-control-sm" wire:model.live="state.fecha_inicio" type="month">
                                            @error('state.fecha_inicio')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Fech. Fin <font style="color:red">(*)</font></label>
                                            <input class="form-control form-control-sm" wire:model.live="state.fecha_fin" type="month">
                                            @error('state.fecha_fin')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <div class="col-lg-12 text-center">
                                            <button type="button" class="btn btn-info" wire:click="aniadir">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="bx bxs-save" style="font-size: 22px;"></i>
                                                    <span style="margin-left: 5px;"><b>Añadir Estudio</b></span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                        <h6 class="mt-4" style="display: flex; align-items: center;">
                            <i class="bx bxs-graduation" style="font-size: 22px; margin-right: 5px;"></i>
                            <span style="margin-right: 5px;"><b>Listado de Estudios</b></span>
                        </h6>
                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                        <div class="col-lg-12">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:5px">#</th>
                                        <th scope="col" style="width:5px">Estado</th>
                                        <th scope="col">Institucion</th>
                                        <th scope="col">Estudio</th>
                                        <th scope="col">Programa</th>
                                        <th scope="col" style="width:5px">Estado</th>
                                        <th scope="col" style="width:5px">Inicio</th>
                                        <th scope="col" style="width:5px">Fin</th>
                                        <th scope="col" style="width:5px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!is_null($estudios))
                                        @foreach($estudios as $key => $estudio)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>
                                                    @if($estudio['estado'])
                                                        <span class="badge bg-success">Se Agregara</span>
                                                    @else
                                                        <span class="badge bg-danger">Se Eliminara</span>
                                                    @endif
                                                </td>
                                                <td>{{$estudio['institucion_nombre']}}</td>
                                                <td>
                                                    @if($estudio['catalogo_tipo_estudio_id'] == 1)
                                                        Educacion Primaria
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 2)
                                                        Educacion Secundaria
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 3)
                                                        Auxiliar Tecnico
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 4)
                                                        Bachiller
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 5)
                                                        Doctorado
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 6)
                                                        Maestria
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 7)
                                                        Profesional Tecnico
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 8)
                                                        Tecnico
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 9)
                                                        Especialidad
                                                    @elseif($estudio['catalogo_tipo_estudio_id'] == 10)
                                                        Titulo
                                                    @endif
                                                </td>
                                                <td>{{$estudio['programa']}}</td>
                                                <td>
                                                    @if($estudio['estado_estudio'] == 1)
                                                        Incompleta
                                                    @elseif($estudio['estado_estudio'] == 2)
                                                        Completa
                                                    @endif
                                                </td>
                                                <td>{{$estudio['fecha_inicio']}}</td>
                                                <td>{{$estudio['fecha_fin']}}</td>
                                                <td>
                                                    @if($estudio['estado'])
                                                        <button type="button" wire:click="eliminar({{$key}})" class="btn btn-danger btn-sm">    
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" wire:click="cancelar({{$key}})" class="btn btn-info btn-sm">    
                                                            <i class="bx bx-no-entry"></i>
                                                        </button>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">
                                                <center><i>Sin Estudios Registrados</i></center>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12">
                        @if($existe != null)
                        <div class="alert alert-secondary material-shadow" role="alert">
                            <strong> Información! </strong>Tiene un archivo pdf ya cargado anteriormente. Si quisiera modificar el archivo de click en reemplazar archivo y seleccione el nuevo archivo, si no se combinara con el archivo anterior.
                        </div>
                        @endif
                        </div>
                        @if($existe)
                            <div class="col-lg-4" style="    text-align: center;     margin-top: 8px">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" wire:model="reemplaza" id="inlineCheckbox6" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox6">Reemplazar</label>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-<?php if($existe){echo '8';}else{echo '12';}?>">
                            <span class="btn btn-light" style="width: 100%">
                                @if($archivo)
                                    <i class="bx bx-check-square" style="color:green"></i>
                                @else
                                    <i class="bx bxs-file-pdf"></i>
                                @endif
                                @php
                                    if($archivo){
                                        echo $archivo->getClientOriginalName();
                                    }else{
                                        echo ' Click para subir archivo';
                                    }
                                @endphp
                                <div wire:loading="" wire:target="Ficha">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                                <input type="file" style="width:100%;height:100%;position:absolute;top:0;left:0;opacity:0;cursor:pointer;" wire:model.live="archivo" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="El archivo debe ser en formato pdf y no debe ser mayor a 100 MB. 
                                                            Si ya cuenta con un archivo guardado anteriormente el sistema lo actualizara con el nuevo archivo" aria-describedby="tooltip692752">
                            </span>
                        </div>
                        <hr class="mt-2">
                        <small>Al darle click en <b>Guardar</b>, el sistema realizara los cambios.</small>
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
</div>