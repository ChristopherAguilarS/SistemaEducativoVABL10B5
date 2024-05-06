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
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label">Descripcion <font style="color:red">(*)</font></label>
                                <input class="form-control" wire:model="state.descripcion" type="text">
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
                                <select class="form-select" wire:model="state.catalogo_ubicacion_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($ubicaciones))
                                        @foreach($ubicaciones as $ubicacion)
                                            <option value="{{$ubicacion['id']}}">{{$ubicacion['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
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
                                <label class="form-label">Condición<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.catalogo_condicion_id">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($condiciones))
                                        @foreach($condiciones as $condicion)
                                            <option value="{{$condicion['id']}}">{{$condicion['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Aforo<font style="color:red">(*)</font></label>
                                <input type="text" wire:model="state.aforo" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Área<font style="color:red">(*)</font></label>
                                <input type="text" wire:model="state.area" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Pabellón<font style="color:red">(*)</font></label>
                                <input type="text" wire:model="state.pabellon" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Piso<font style="color:red">(*)</font></label>
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
                                <label class="form-label">Estado<font style="color:red">(*)</font></label>
                                <select class="form-select" wire:model="state.estado">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                        Añadir
                    </button>
                </div>
            </div><!-- /.modal-content -['
        </']div><!-- /.modal-dialog -['
    </']div><!-- /.modal -['
</']div>
