<div class="modal fade" id="form3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h5 class="text-white modal-title" id="exampleModalLabel">Buscar por Código</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 mb-3 text-left">
                        <label><b>Tipo de busqueda</b></label>
                        <select class="form-control" wire:model="tipo">
                            <option value="1">Por Código Patrimonial</option>
                            <option value="2">Por Número de Serie</option>
                            <option value="3">Por Código de Barras</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3 text-left">
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model.defer="codigo">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" wire:click="buscar" type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    @if(!$existe && $buscar)
                        <div class="col-sm-12 col-md-12 mb-3 text-left">
                            <div class="alert alert-warning" role="alert">
                                <i class="mdi mdi-alert-outline mr-2"></i> Este <strong>equipo</strong> no se encuentra se encuentra registrado.
                            </div>
                        </div>
                    @endif
                    @if($buscar)
                        <div class="col-sm-12 col-md-12 mb-3 text-left">
                            <label><b>Código Patrimonial</b></label>
                            <input type="text" wire:model.defer="state.CODIGO_ACTIVO" class="form-control" @if($existe) disabled @endif>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3 text-left">
                            <label><b>Denominación</b></label>
                            <input type="text" wire:model.defer="state.DESCRIPCION" class="form-control" @if($existe) disabled @endif>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3 text-left">
                            <label><b>Serie</b></label>
                            <input type="text" wire:model.defer="state.NRO_SERIE" class="form-control" @if($existe) disabled @endif>
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3 text-left">
                            <label><b>Marca</b></label>
                            <input type="text" wire:model.defer="state.MARCA" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3 text-left">
                            <label><b>Modelo</b></label>
                            <input type="text" wire:model.defer="state.MODELO" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3 text-left">
                            <label><b>Color</b></label>
                            <input type="text" wire:model.defer="state.COLOR" class="form-control">
                        </div>
                        @if(!$existe)                            
                            
                            <div class="col-sm-12 col-md-12 mb-3 text-left">
                                <label><b>Estado</b></label>
                                <select class="form-control" wire:model="state.estado">
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                    <option value="4">Muy Malo</option>
                                    <option value="5">Nuevo</option>
                                    <option value="6">Chatarra</option>
                                    <option value="7">RAEE</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-left mb-3" style="border-bottom: 1px solid #e9ecef;">
                                <h5 class="mb-2 card-title">
                                    <b> 
                                        <span style="font-size: 24px;" class="mdi mdi-account-reactivate"></span> 
                                        Trabajador | 
                                    </b> 
                                </h5>
                            </div>

                            <div class="col-sm-12 col-md-12 mb-3 text-left">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="Nro. Documento" wire:model.prevent="dni">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" wire:click="buscar2" type="button"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-sm-12 col-md-12 mb-3 text-left">
                                <label><b>Trabajador</b></label>
                                <input type="text" wire:model.defer="nombres" class="form-control" disabled>
                            </div>
                        @else
                            <div class="col-sm-12 col-md-12 mb-3 text-center">
                                <button type="button" class="btn waves-effect waves-light btn-info" wire:click="IrEq">
                                    <i class="fa fa-external-link-square"></i> | IR
                                </button>
                            </div>
                            
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancelar</button>
                    <button type="button" class="btn waves-effect waves-light btn-info" wire:click="save">
                        <i class="fa fa-save"></i> | GUARDAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
