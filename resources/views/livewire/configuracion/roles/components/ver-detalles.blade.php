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
                        <div class="col-xxl-12">
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre del Rol</label>
                                        <input type="text" class="form-control" wire:model.live="state.name">
                                        @error('state.name')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Modulo</label>
                                        <select wire:model="state.modulo_id" class="form-select">
                                            <option value="0">Seleccione</option>
                                            @foreach($modulos as $modulo)
                                                <option value="{{$modulo->id}}">{{$modulo->nombre}}</option>
                                            @endforeach
                                        </select>
                                        @error('state.modulo_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Estado</label>
                                        <select wire:model="state.estado" class="form-select">
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                        @error('state.estado')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    @if($tipo == 1 || $tipo == 3)
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
