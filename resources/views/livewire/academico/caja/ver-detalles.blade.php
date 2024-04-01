<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="codigo" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="codigo" wire:model='state.nombre'>
                            <div>
                                @error('state.nombre') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="descripcion" class="col-form-label">Estado:</label>
                            <select class="form-select mb-3" wire:model="state.estado" aria-label="Default select example">
                                <option value="1">Activo</option> 
                                <option value="0">Inactivo</option>  
                            </select>
                            <div>
                                @error('state.estado') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"  wire:click='guardar'>Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
