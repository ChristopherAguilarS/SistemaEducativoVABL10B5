<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Añadir Equipo a la Seccion Prestamos
</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label" for="steparrow-gen-info-email-input">Código Patrimonial <font style="color:red">(*)</font></label>
                                <div class="input-group">
                                    <input type="text" wire:model.defer="CODIGO_ACTIVO" class="form-control">
                                    <a class="input-group-text cursor-pointer" wire:click="buscar(1)"><i class="bx bx-search-alt-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="mb-3">
                                <label class="form-label" for="steparrow-gen-info-email-input">Denominacion <font style="color:red">(*)</font></label>
                                <input class="form-control" wire:model.defer="DESCRIPCION" type="text" disabled="">
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
