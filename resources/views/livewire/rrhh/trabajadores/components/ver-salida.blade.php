    <div wire:ignore.self id="form6" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                            <span style="margin-right: 5px;"><b>Informacion del Merito</b></span>
                                        </h6>
                                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Fecha Fin</label>
                                                <input class="form-control" wire:model.live="state.fecha_emision" type="date">
                                                @error('state.fecha_emision') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Motivo</label>
                                                <select class="form-select" wire:model.live="state.catalogo_motivo_id">
                                                    <option value="0">-- Seleccione</option>
                                                    @if(!is_null($motivos))
                                                        @foreach($motivos as $motivo)
                                                            <option value="{{$motivo->id}}">{{$motivo->descripcion}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('state.catalogo_motivo_id') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Observaciones</label>
                                                <textarea class="form-control"  wire:model="state.observaciones" rows="2"></textarea>
                                                @error('state.observaciones') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                                            </div>
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
