<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{$titulo}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Expediente</label>
                                <input type="text" class="form-control" wire:model="correlativo" style="text-align:center" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <input type="text" class="form-control" wire:model="estado" disabled>
                            </div>
                        </div>
                        @if($tipo == 2)
                            <div class="col-lg-12">
                                <label><b>Área:</b></label> 
                                <select class="form-select" wire:model.live="area">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($areas))
                                        @foreach($areas as $area)
                                            <option value="{{$area['id']}}">{{$area['descripcion']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('area') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                            </div>
                            <div class="col-lg-12"></div>
                            <div class="col-lg-12 mt-3">
                                <label><b>Trabajador:</b></label>    
                                <select class="form-select" wire:model.live="persona">
                                    <option value="0">Seleccione</option>
                                    @if(!is_null($personas))
                                        @foreach($personas as $persona)
                                            <option value="{{$persona['id']}}">{{$persona['apellidoPaterno'].' '.$persona['apellidoMaterno'].' '.$persona['nombres']}}</option>
                                        @endforeach
                                     @endif
                                </select>
                                @error('persona') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                            </div>
                        @endif
                        <div class="col-lg-12"></div>
                        <div class="col-lg-12 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Observaciones</label>
                                <textarea wire:model="observaciones" class="form-control" rows="3" @if(!$tipo) disabled @endif></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Recibido Fecha</label>
                                <input type="date" class="form-control" wire:model="fecha_recibido" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <div class="mb-3">
                                <label class="form-label">Recibido Hora</label>
                                <input type="text" class="form-control" wire:model="hora_recibido" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    @if($tipo)
                        <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                            <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                            <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                            Guardar
                        </button>
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
