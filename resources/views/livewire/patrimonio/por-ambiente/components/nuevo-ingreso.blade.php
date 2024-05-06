<div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $tituloModal }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Registrado en el SIGA?</label>
                                        <select class="form-select" wire:model.live="state.SIGA">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('state.catalogo_tipo_documento') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12" style="text-align:center; display:<?php echo ($state['SIGA']==1)?'block':'none' ?>">
                                    @if($urlFoto)
                                    <img src="/images/equipamiento/catalogo_equipos/{{ $urlFoto }}" height="200">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="row">
                                @if($state['SIGA'])
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Código Patrimonial <font style="color:red">(*)</font></label>
                                            <div class="input-group">
                                                <input type="text" wire:model="state.CODIGO_ACTIVO" class="form-control">
                                                <a class="input-group-text cursor-pointer" wire:click="buscar(1)"><i class="bx bx-search-alt-2"></i></a>
                                            </div>
                                            @error('state.CODIGO_ACTIVO') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Denominacion <font style="color:red">(*)</font></label>
                                            <input class="form-control" wire:model="state.DESCRIPCION" type="text">
                                            @error('state.DESCRIPCION') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Familia<font style="color:red">(*)</font></label>
                                            <input type="text" wire:model="familia" class="form-control" disabled>
                                            @error('familia') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                @else
                                    <?php $confirma = 1; ?> 
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label><b>Denominación<font style="color:red">*</font></b></label>
                                            <input type="text" wire:model="state.DESCRIPCION" class="form-control" @if(!$confirma) disabled @endif >
                                            @error('state.DESCRIPCION')
                                                <span class="text-danger-emphasis">(*)Obligatorio</span>
                                            @enderror
                                        </div> 
                                    </div>   
                                @endif
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Serie<font style="color:red">(*)</font></label>
                                        <input type="text" wire:model="state.NRO_SERIE" class="form-control">
                                        @error('state.NRO_SERIE') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Estado<font style="color:red">(*)</font></label>
                                            <select class="form-select" wire:model="state.ESTADO_CONSERV" @if(!$confirma) disabled @endif>
                                                <option value="5">Nuevo</option>
                                                <option value="1" selected="">Bueno</option>
                                                <option value="2">Regular</option>
                                                <option value="3">Malo</option>
                                                <option value="4">Muy Malo</option>
                                                <option value="6">Chatarra</option>
                                                <option value="7">RAEE</option>
                                            </select>
                                            @error('state.ESTADO_CONSERV') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Marca<font style="color:red">(*)</font></label>
                                            <input type="text" wire:model="state.MARCA" class="form-control" @if(!$confirma) disabled @endif>
                                            @error('state.MARCA') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Modelo<font style="color:red">(*)</font></label>
                                            <input type="text" wire:model="state.MODELO" class="form-control" @if(!$confirma) disabled @endif>
                                            @error('state.MODELO') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Color<font style="color:red">(*)</font></label>
                                            <input type="text" wire:model="state.COLOR" class="form-control" @if(!$confirma) disabled @endif>
                                            @error('state.COLOR') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Ancho</label>
                                            <div class="input-group">
                                                <input type="number" wire:model="state.ANCHO" class="form-control">
                                                <span class="input-group-text"><b>CM</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Largo</label>
                                            <div class="input-group">
                                                <input type="number" wire:model="state.LARGO" class="form-control">
                                                <span class="input-group-text"><b>M</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Alto</label>
                                            <div class="input-group">
                                                <input type="number" wire:model="state.ALTO" class="form-control">
                                                <span class="input-group-text"><b>CM</b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12"><hr></div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Tipo<font style="color:red">(*)</font></label>
                                            <select class="form-control" wire:model="tipo" @if(!$confirma) disabled @endif>
                                                <option value="1">Equipo</option>
                                                <option value="2">Componente</option>
                                            </select>
                                            @error('state.COLOR') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">En Uso<font style="color:red">(*)</font></label>
                                            <select class="form-select" wire:model="state.EN_USO">
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('state.en_uso') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label">Fecha Compra<font style="color:red">(*)</font></label>
                                            <input type="date" class="form-control" wire:model="state.FECHA_COMPRA">
                                            @error('state.FECHA_COMPRA') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="card-header bg-light" style="    margin-left: 10px;">
                                <div class="row" style="padding: 10px 25px;">
                                    <h6 style="display: flex; align-items: center;">
                                        <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                        <span style="margin-right: 5px;"><b> Ubicación del bien/equipo | Campos opcionales.</b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Nro. Documento <font style="color:red">(*)</font></label>
                                            <div class="input-group">
                                                <input type="text" wire:model.live="documento" class="form-control">
                                                <a class="input-group-text cursor-pointer" wire:click="buscar2"><i class="bx bx-search-alt-2"></i></a>
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
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Ambiente</label>
                                            <select class="form-select" wire:model.live="state.ambiente_id">
                                                <option value="0">-- Seleccione</option>
                                                @foreach($ambientes as $amiente)
                                                    <option value="{{$amiente->id}}">{{$amiente->nombre}}</option>
                                                @endforeach
                                            </select>
                                            @error('state.ambiente_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                    @if($editar)
                        <button type="button" class="btn btn-info material-shadow-none" wire:click="guardar">Guardar</button>
                    @endif
                    <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
