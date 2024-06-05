<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Carné</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                <div class="modal-body" style="padding:0px">
                    <div class="row p-2">                        
                        <div class="col-lg-6">
                            <label><b>Tipo</b></label>
                            <select class="form-select" wire:model="state.tipo">
                                <option value="1">Alumno</option>
                                <option value="2">Docente</option>
                                <option value="3">Otro</option>
                            </select>
                            @error('entrega.fecha')
                                <small style="color:red">(*) Obligatorio</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label><b>Documento</b></label>
                            <div class="input-group">
                                <input type="text" wire:model="state.documento" class="form-control">
                                <button type="button" class="btn btn-info " wire:click="buscar" wire:loading.attr="disabled">
                                    <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="buscar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                                    <i class="bx bx-search-alt-2" wire:loading.remove="" wire:target="buscar"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label><b>Apellidos y Nombres</b></label>
                            <input type="text" class="form-control" wire:model="state.nombres" disabled>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <label><b>Periodo</b></label>
                            <select class="form-select" wire:model="state.periodo">
                                <?php
                                    for ($i=2024; $i <= date('Y'); $i++) { 
                                        ?><option value="{{$i}}">{{$i}}</option><?php
                                    }
                                ?>
                            </select>
                            @error('entrega.fecha')
                                <small style="color:red">(*) Obligatorio</small>
                            @enderror
                        </div>
                        <div class="col-lg-8 mt-2">
                            <label><b>Etiqueta</b></label>
                            <input type="text" class="form-control" wire:model="state.etiqueta">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
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
