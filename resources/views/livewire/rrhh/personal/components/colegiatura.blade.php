<div>
    <div wire:ignore.self id="form4" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                        <span style="margin-right: 5px;"><b>Nueva Colegiatura</b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input" >Colegio Profesional <font style="color:red">(*)</font></label>
                                            <select class="form-control form-control-sm"  wire:model.live="state.catalogo_colegio_id">
                                                    <option value="0">Seleccione un estado</option>
                                                    @if(!is_null($colegios))
                                                        @foreach($colegios as $colegio)
                                                            <option value="{{$colegio->id}}">{{$colegio->descripcion}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            @error('state.catalogo_colegio_id')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Fecha <font style="color:red">(*)</font></label>
                                            <input class="form-control form-control-sm" wire:model.live="state.fecha" type="date">
                                            @error('state.fecha')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Número <font style="color:red">(*)</font></label>
                                            <input class="form-control form-control-sm" wire:model.live="state.numero" type="text">
                                            @error('state.numero')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-center">
                                        <div class="col-lg-12 text-center">
                                            <button type="button" class="btn btn-info" wire:click="aniadir">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="bx bxs-save" style="font-size: 22px;"></i>
                                                    <span style="margin-left: 5px;"><b>Añadir</b></span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                        <h6 class="mt-4" style="display: flex; align-items: center;">
                            <i class="bx bxs-graduation" style="font-size: 22px; margin-right: 5px;"></i>
                            <span style="margin-right: 5px;"><b>Listado de Trabajos</b></span>
                        </h6>
                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                        <div class="col-lg-12">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:5px">#</th>
                                        <th scope="col">Colegio Profesional</th>
                                        <th scope="col" style="width:5px">Fecha</th>
                                        <th scope="col" style="width:5px">Numero</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!is_null($estudios))
                                        @foreach($estudios as $key => $estudio)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$estudio['colegio']}}</td>
                                                <td>{{date('d/m/Y', strtotime($estudio['fecha']))}}</td>
                                                <td>{{$estudio['numero']}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">
                                                <center><i>Sin Trabajos Registrados</i></center>
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