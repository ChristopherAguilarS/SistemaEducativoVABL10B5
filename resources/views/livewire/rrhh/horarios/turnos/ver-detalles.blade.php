<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-12">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Datos Personales | Los campos con (*) son obligatorios.</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre <font style="color:red">(*)</font></label>
                                        <input type="text" class="form-control" wire:model.live="state.descripcion">
                                        @error('state.descripcion')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Abreviatura <font style="color:red">(*)</font></label>
                                        <input type="text" class="form-control" wire:model.live="state.abreviatura">
                                        @error('state.abreviatura')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Inicio <font style="color:red">(*)</font></label>
                                        <input type="time" class="form-control" wire:model.live="state.horaInicio">
                                        @error('state.horaInicio')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Fin <font style="color:red">(*)</font></label>
                                        <input type="time" class="form-control"  wire:model.live="state.horaFin">
                                        @error('state.horaFin')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                    <label class="form-label">Estado <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.estado" >
                                            <option value="0">Inactivo </option>
                                            <option value="1" wire:key="1">Activo</option>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                        Guardar
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
