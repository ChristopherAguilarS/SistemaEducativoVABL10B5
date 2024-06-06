<div class="row">
<div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">(1) Documento</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-1">
                        <div class="col-lg-4" style="text-align:right">
                            <label><b>Tipo Documento:</b></label>    
                        </div>
                        <div class="col-lg-2">
                            <select class="form-select" wire:model="state.catalogo_tipo_documento_id">
                                <option value="0">Seleccione</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->descripcion}}</option>
                                @endforeach
                            </select>
                            @error('state.catalogo_tipo_documento_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <input type="text" wire:model="numero" class="form-control" placeholder="numero" style="text-align:center">
                                <button type="button" class="btn btn-info " wire:click="correlativo" wire:loading.attr="disabled">
                                    <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="correlativo" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                                    <i class="bx bx-refresh" style="font-size: 16px;" wire:loading.remove="" wire:target="correlativo"></i>
                                </button>
                            </div>
                            @error('numero') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                        </div>
                        <div class="col-lg-12"></div>
                        <div class="col-lg-4" style="text-align:right">
                            <label><b>Folios:</b></label>    
                        </div>
                        <div class="col-lg-4">
                            <input type="number" wire:model="state.folios" class="form-control">
                            @error('state.folios') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                        </div>
                        <div class="col-lg-12"></div>
                        <div class="col-lg-4" style="text-align:right">
                            <label><b>Asunto:</b></label>    
                        </div>
                        <div class="col-lg-4">
                            <input type="text" wire:model="state.asunto" class="form-control">
                            @error('state.asunto') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                        </div>
                        <div class="col-lg-12"></div>
                        <div class="col-lg-4" style="text-align:right">
                            <label><b>Archivo PDF (Max. 20MB):</b></label>    
                        </div>
                        <div class="col-lg-4">
                            <input type="file" class="form-control" wire:model="pdf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card" style="    height: 100%;">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">(2) Remitente</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row align-items-center g-1">
                                    <div class="col-lg-4" style="text-align:right">
                                        <label><b>Tipo Remitente:</b></label>    
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-select" wire:model="state.tipo_remitente">
                                            <option value="1">Natural</option>
                                            <option value="2">Juridica</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-12"></div>
                                    <div class="col-lg-4" style="text-align:right">
                                        <label>
                                            <b>
                                                @if($state['tipo_remitente'] == 1)
                                                    N° D.N.I.:
                                                @else
                                                    N° R.U.C.:
                                                @endif
                                            </b>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input type="text" wire:model="state.remitente_documento" class="form-control">
                                            <button type="button" class="btn btn-info " wire:click="buscar" wire:loading.attr="disabled">
                                                <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="buscar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                                                <i class="bx bx-search-alt-2" wire:loading.remove="" wire:target="buscar"></i>
                                            </button>
                                        </div>
                                        @error('state.remitente_documento') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                    <div class="col-lg-12"></div>
                                    <div class="col-lg-4" style="text-align:right">
                                        <label>
                                            <b>
                                                @if($state['tipo_remitente'] == 1)
                                                    Nombre:
                                                @else
                                                    Razón Social:
                                                @endif
                                            </b>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" wire:model="state.remitente_nombre">
                                        @error('state.remitente_nombre') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                    <div class="col-lg-12"></div>
                                    <div class="col-lg-4" style="text-align:right">
                                        <label><b>Correo Electrónico:</b></label>    
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" wire:model="state.correo">
                                    </div>
                                    <div class="col-lg-12"></div>
                                    <div class="col-lg-4" style="text-align:right">
                                        <label><b>Tlf. Celular:</b></label>    
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" wire:model="state.telefono">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" style="    height: 100%;">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">(3) Destino</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row align-items-center g-1">
                                <div class="col-lg-12">
                                        <br><br><br>
                                    </div>
                                    <div class="col-lg-4" style="text-align:right">
                                        <label><b>Área:</b></label>    
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-select" wire:model.live="state.catalogo_area_id">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($areas))
                                                @foreach($areas as $area)
                                                    <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogo_area_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                    <div class="col-lg-12"></div>
                                    <div class="col-lg-4" style="text-align:right">
                                        <label><b>Trabajador:</b></label>    
                                    </div>
                                    <div class="col-lg-6">
                                        <select class="form-select" wire:model.live="state.persona_id">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($personas))
                                                @foreach($personas as $persona)
                                                    <option value="{{$persona['id']}}">{{$persona['apellidoPaterno'].' '.$persona['apellidoMaterno'].' '.$persona['nombres']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.persona_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <br><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
            <hr>
            <div class="row mt-2">
                <div class="col-lg-12" style="text-align: center;">
                    <button type="button" class="btn btn-light" wire:click="limpiar">Limpiar</button>
                    
                    <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                        @if($guardado)
                            Ver Codigo
                        @else
                            Guardar
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


