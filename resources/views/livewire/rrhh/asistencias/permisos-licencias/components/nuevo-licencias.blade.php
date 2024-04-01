    <div wire:ignore.self id="form3" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                <hr class="mb-3" style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                
                                <div class="card-header bg-light" style="    margin-left: 10px;">
                                    <div class="row" style="padding: 10px 25px;">
                                        <h6 style="display: flex; align-items: center;">
                                            <i class="bx bx-sun" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>Nuevo Ingreso de Permiso</b></span>
                                        </h6>
                                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        <div class="col-lg-12"></div>
                                        <div class="col-lg-4">
                                            <div class="mb-2">
                                                <span>Tipo de Permiso:</span>
                                                <select wire:model.live="tipo" class="form-select">
                                                    <option value="0">Sin goce de haber</option>
                                                    <option value="1">Con goce de haber</option>
                                                </select>
                                                @error('tipo')
                                                    <span class="block text-left text-tiny sm:col-span-12 text-error">* Campo Obligatorio</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="mb-2">
                                                <span>Motivo de Licencia:</span>
                                                <select wire:model="motivo" class="form-select">
                                                    <option value="0">Seleccione</option>
                                                    @foreach($motivos as $mto)
                                                        <option value="{{$mto->id}}">{{$mto->descripcion}}</option>
                                                    @endforeach
                                                </select>
                                                @error('motivo')
                                                    <span class="block text-left text-tiny sm:col-span-12 text-error">* Campo Obligatorio</span>
                                                @enderror
                                            </div>
                                        </div> 
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <span>Inicio:</span>
                                                <input wire:model="fecha_inicio" onchange="calcDias()" class="form-control" type="date">
                                                @error('fecha_inicio')
                                                    <span class="block text-left text-tiny sm:col-span-12 text-error">* Campo Obligatorio</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <span>Fin:</span>
                                                <input wire:model="fecha_fin" onchange="calcDias()" class="form-control" type="date">
                                                @error('fecha_fin')
                                                    <span class="block text-left text-tiny sm:col-span-12 text-error">* Campo Obligatorio</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <span>Observaciones:</span>
                                                <textarea wire:model="observaciones" class="form-control" cols="30" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12"><br></div>
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
                                <div wire:loading="" wire:target="Ficha" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background-color: rgba(255, 255, 255, 0.5);">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                                <input type="file" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;" wire:model.live="archivo">
                            </label>
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
