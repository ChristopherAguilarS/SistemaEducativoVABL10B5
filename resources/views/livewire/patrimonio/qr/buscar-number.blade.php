<div wire:ignore.self id="form2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-l">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Buscar Equipo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body"><hr style="width:100%; margin-top:-10px">
            <div class="row">
                    <div class="col-sm-12 col-md-12 mb-3 text-left">
                        <label><b>Tipo de busqueda</b></label>
                        <select class="form-control" wire:model.live="tipo">
                            <option value="1">Por Código Patrimonial</option>
                            <option value="2">Por Número de Serie</option>
                            <option value="3">Por Código de Barras</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3 text-left">
                        <div class="input-group">
                            <input type="text" wire:model="codigo" class="form-control">
                            <a class="input-group-text cursor-pointer" wire:click="buscarEq(1)"><i class="bx bx-search-alt-2"></i></a>
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
            </div>
            <div class="modal-footer"><br><hr style="width:100%; margin-top:-10px">
                <button type="button" class="btn btn-outline-info" wire:click="save"><i class="fa fa-times mr-1"></i>Eliminar</button>

                <button type="button" class="btn btn-light material-shadow-none" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>






