<div class="modal fade" id="form2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h5 class="text-white modal-title" id="exampleModalLabel">{{$titulo}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(!$edicion)
                    <div class="form-group row">
                        <label class="text-left col-sm-3 control-label col-form-label"><b>Tipo</b></label>
                        <div class="col-sm-9">
                            <select class="form-control" wire:model="tipo">
                                <option value="1">Inventariar</option>
                                <option value="2">Desplazar</option>
                            
                            </select>
                        </div>
                    </div>
                @endif
                
                <div class="form-group row">
                    <label class="text-left col-sm-3 control-label col-form-label"><b>Estado</b></label>
                    <div class="col-sm-9">
                        <select class="form-control" wire:model="estado">
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
                    <div class="col-md-12">
                        <br>
                        <h4 class="mb-0"><i class="mdi mdi-account-switch"></i> Información del Desplazamiento</h4>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label><b>Busq. D.N.I</b></label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" wire:model="dni">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" wire:click="buscar" type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label><b>Apellidos y Nombres</b></label>
                        <input type="text" class="form-control" wire:model.defer="nombres" disabled>
                        <input type="hidden" wire:model="persona_id">
                    </div>
                @endif
                <div class="modal-footer">
                    
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
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
