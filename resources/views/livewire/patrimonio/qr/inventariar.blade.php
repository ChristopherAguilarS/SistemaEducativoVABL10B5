<div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body"><hr style="width:100%; margin-top:-10px">
                @if(!$edicion)
                    <div class="form-group row">
                        <label class="text-left col-3 control-label col-form-label"><b>Tipo</b></label>
                        <div class="col-9">
                            <select class="form-select" wire:model.live="tipo">
                                <option value="1">Inventariar</option>
                                <option value="2">Desplazar</option>
                            
                            </select>
                        </div>
                    </div>
                @endif
                
                <div class="form-group row mt-2">
                    <label class="text-left col-3 control-label col-form-label"><b>Estado</b></label>
                    <div class="col-9">
                        <select class="form-select" wire:model="estado">
                            <option value="1">Bueno</option>
                            <option value="2">Regular</option>
                            <option value="3">Malo</option>
                            <option value="4">Muy Malo</option>
                            <option value="5">Nuevo</option>
                            <option value="6">Chatarra</option>
                            <option value="7">RAEE</option>
                        </select>
                    </div>
                </div>
                @if($tipo == 2)
                    <div class="col-12">
                        <br>
                        <h5 class="mb-0"><i class="mdi mdi-account-switch"></i> Información del Desplazamiento</h5>
                        <hr>
                    </div>
                    <div class="col-12 mb-2">
                        <label><b>Busq. D.N.I</b></label>
                        <div class="input-group">
                            <input type="text" wire:model="dni" class="form-control">
                            <a class="input-group-text cursor-pointer" wire:click="buscar"><i class="bx bx-search-alt-2"></i></a>
                        </div>
                    </div>
                    <div class="col-12">
                        <label><b>Apellidos y Nombres</b></label>
                        <input type="text" class="form-control" wire:model.defer="nombres" disabled>
                        <input type="hidden" wire:model="persona_id">
                    </div>
                @endif
                @error('persona_id') <span class="text-danger-emphasis">(*)Debes Asignar el equipo a un trabajador</span> @enderror
            </div>
            <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                <button type="button" class="btn btn-outline-danger" wire:click="delInv"><i class="fa fa-times mr-1"></i>Eliminar</button>
                    @if($edicion)
                        <button type="button" class="btn waves-effect waves-light btn-info" wire:click="save2">
                            <i class="fa fa-edit"></i> | Editar
                        </button>
                    @else
                        <button type="button" class="btn waves-effect waves-light btn-info" wire:click="save">
                            @if($tipo == 2)
                                <i class="fa fa-save"></i> | Guardar
                            @else
                                <i class="fa fa-check"></i> | Inventariar
                            @endif
                        </button>
                    @endif
                <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>