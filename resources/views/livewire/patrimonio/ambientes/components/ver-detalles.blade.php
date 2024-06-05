<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Añadir Ambiente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Nombre del ambiente<font style="color:red">(*)</font></label>
                                <input type="text" wire:model="state.nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Tipo de Ambiente<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.catalogo_tipo_ambiente_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($tipos))
                                        @foreach($tipos as $tipo)
                                            <option value="{{$tipo['id']}}">{{$tipo['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Ubicación<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.catalogo_pabellon_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($pabellones))
                                        @foreach($pabellones as $ubicacion)
                                            <option value="{{$ubicacion['id']}}">{{$ubicacion['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Nivel<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.catalogo_piso_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($pisos))
                                        @foreach($pisos as $piso)
                                            <option value="{{$piso['id']}}">{{$piso['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Estado Conservacion<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.estado_conservacion">
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Uso de Ambiente<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.catalogo_uso_ambiente_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($usos))
                                        @foreach($usos as $uso)
                                            <option value="{{$uso['id']}}">{{$uso['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Aforo<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.aforo" class="form-control">
                                    <span class="input-group-text">personas</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Largo<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.largo" class="form-control">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Ancho<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.ancho" class="form-control">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Alto<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.alto" class="form-control">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Area<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.area" class="form-control">
                                    <span class="input-group-text">m2</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo Uso<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.tipo_uso">
                                    <option value="1">Exclusivo</option>
                                    <option value="2">Compartido</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Puertas<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.puertas" class="form-control">
                                    <span class="input-group-text">Und.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Ventanas<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.ventanas" class="form-control">
                                    <span class="input-group-text">Und.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo Techo<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.catalogo_tipo_techo_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($techos))
                                        @foreach($techos as $condicion)
                                            <option value="{{$condicion['id']}}">{{$condicion['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Tipo Piso<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.catalogo_tipo_piso_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($tipos_pisos))
                                        @foreach($tipos_pisos as $condicion)
                                            <option value="{{$condicion['id']}}">{{$condicion['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Luces de Emergencia<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.luces_emergencia" class="form-control">
                                    <span class="input-group-text">Und</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Alarma Contra Incendios<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.alarmas" class="form-control">
                                    <span class="input-group-text">Und</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Extintores<font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model="state.extintores" class="form-control">
                                    <span class="input-group-text">Und</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-light">
                        <div class="row" style="padding: 10px 20px;">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;"><b>Escritorios</b></span>
                            </h6>
                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Total<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.escritorios_total" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Bueno<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.escritorios_buenos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Regular<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.escritorios_regulares" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Malo<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.escritorios_malos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-light mt-2">
                        <div class="row" style="padding: 10px 20px;">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;"><b>Sillas</b></span>
                            </h6>
                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Total<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.sillas_total" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Bueno<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.sillas_buenos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Regular<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.sillas_regulares" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Malo<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.sillas_malos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-light mt-2">
                        <div class="row" style="padding: 10px 20px;">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;"><b>Carpetas</b></span>
                            </h6>
                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Total<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.carpetas_total" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Bueno<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.carpetas_buenos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Regular<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.carpetas_regulares" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Malo<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.carpetas_malos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-light mt-2">
                        <div class="row" style="padding: 10px 20px;">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;"><b>Armarios</b></span>
                            </h6>
                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Total<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.armarios_total" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Bueno<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.armarios_buenos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Regular<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.armarios_regulares" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Malo<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.armarios_malos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-light mt-2">
                        <div class="row" style="padding: 10px 20px;">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;"><b>Proyectores</b></span>
                            </h6>
                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Total<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.proyectores_total" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Bueno<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.proyectores_buenos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Regular<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.proyectores_regulares" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Malo<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.proyectores_malos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-light mt-2">
                        <div class="row" style="padding: 10px 20px;">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;"><b>Pizarras</b></span>
                            </h6>
                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Total<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.pizarras_total" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Bueno<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.pizarras_buenos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Regular<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.pizarras_regulares" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Malo<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.pizarras_malos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-header bg-light mt-2">
                        <div class="row" style="padding: 10px 20px;">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;"><b>Otros Muebles</b></span>
                            </h6>
                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Total<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.otros_total" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Bueno<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.otros_buenos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Regular<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.otros_regulares" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label class="form-label">Malo<font style="color:red">(*)</font></label>
                                    <div class="input-group">
                                        <input type="text" wire:model="state.otros_malos" class="form-control">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Estado<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.estado">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="mb-3">
                                <label class="form-label">Observaciones<font style="color:red">(*)</font></label>
                                <textarea wire:model="state.observaciones" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                        Añadir
                    </button>
                </div>
            </div><!-- /.modal-content -['
        </']div><!-- /.modal-dialog -['
    </']div><!-- /.modal -['
</']div>
