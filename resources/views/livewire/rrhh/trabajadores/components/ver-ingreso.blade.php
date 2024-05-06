<div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Nro. Documento <font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model.live="documento" class="form-control">
                                        <a class="input-group-text cursor-pointer" wire:click="buscar"><i class="bx bx-search-alt-2"></i></a>
                                    </div>
                                    @error('documento') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Apellidos y Nombres <font style="color:red">(*)</font></label>
                                    <input class="form-control" wire:model.live="nombres" type="text" disabled>
                                    @error('nombres') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-header bg-light" style="    margin-left: 10px;">
                                    <div class="row" style="padding: 10px 25px;">
                                        <h6 style="display: flex; align-items: center;">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>Informacion del Ingreso</b></span>
                                        </h6>
                                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Tipo de Documento</label>
                                                <select class="form-select" wire:model.live="state.catalogo_tipo_documento">
                                                    <option>-- Seleccione</option>
                                                    <option value="1">RESOLUCIÓN DIRECTORIAL</option>
                                                    <option value="2">CONTRATO</option>
                                                    <option value="3">CONTRATO ADMINIST.DE SERVICIOS</option>
                                                    <option value="4">ORDEN DE SERVICIO</option>
                                                    <option value="5">PROVEIDO</option>
                                                    <option value="6">MEMORANDUM</option>
                                                    <option value="7">POR CONVENIO</option>
                                                </select>
                                                @error('state.catalogo_tipo_documento') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Regimen</label>
                                                <select class="form-select" wire:model.live="regimen">
                                                    <option value="0">-- Seleccione</option>
                                                    @foreach($regimenes as $regimen)
                                                        <option value="{{$regimen->id}}">{{$regimen->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                @error('regimen') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Condicion</label>
                                                <select class="form-select" wire:model.live="state.catalogo_condiciones_id">
                                                    <option value="0" selected="">Seleccione </option>
                                                    @if(!is_null($condiciones))
                                                        @foreach($condiciones as $condicion)
                                                            <option value="{{$condicion->id}}">{{$condicion->descripcion}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('state.catalogo_condiciones_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Tipo</label>
                                                <select class="form-select" wire:model.live="state.catalogo_tipo_trabajador_id">
                                                    <option value="1" selected="">Administrativo </option>
                                                    <option value="2">Docente</option>
                                                </select>
                                                @error('state.catalogo_tipo_trabajador_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Inicio</label>
                                                <input class="form-control" wire:model.live="state.fecha_inicio" type="date">
                                                @error('state.fecha_inicio') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Fin</label>
                                                <input class="form-control" wire:model.live="state.fecha_fin" type="date">
                                                @error('state.fecha_fin') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Area</label>
                                                <select class="form-select" wire:model.live="state.catalogo_area_id">
                                                    <option value="0" selected="">Seleccione </option>
                                                    @foreach($areas as $area)
                                                        <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                @error('state.catalogo_area_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Tipo</label>
                                                <select class="form-select" wire:model.live="state.catalogo_tipo_personal">
                                                    <option value="0" selected="">Seleccione </option>
                                                    @foreach($areas as $area)
                                                        <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                @error('state.catalogo_area_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Cargo</label>
                                                <select class="form-select" wire:model.live="state.catalogo_cargo_id">
                                                    <option value="0" selected="">Seleccione </option>
                                                    @foreach($cargos as $cargo)
                                                        <option value="{{$cargo->id}}">{{$cargo->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                @error('state.catalogo_cargo_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
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
                                            <label class="btn btn-light" style="width: 100%; position: relative;">
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
                                                <div wire:loading="" wire:target="archivo" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background-color: rgba(255, 255, 255, 0.5);">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>
                                                <input type="file" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" wire:model.live="archivo">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                    <button type="button" class="btn btn-info material-shadow-none" wire:click="guardar">Guardar</button>
                    <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
