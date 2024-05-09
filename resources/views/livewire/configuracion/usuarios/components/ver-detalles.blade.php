<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{$titulo}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                <div class="modal-body" style="padding: 0px 20px;">
                    <div class="row">
                        <h6 style="display: flex; align-items: center;">
                            <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                            <span style="margin-right: 5px;"><b>Información del Usuario</b></span>
                        </h6>
                        <hr class="mb-3" style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Buscar Por</label>
                                <select wire:model.live="buscar_por" class="form-select">
                                    <option value="1">D.N.I.</option>
                                    <option value="0">Por Nombres</option>
                                 </select>
                            </div>
                        </div>
                        @if($buscar_por)
                            <div class="col-lg-3">
                                <label class="form-label">Nro. Documento</label>
                                <div class="input-group mb-3">
                                    <input type="text" wire:model="documento" class="form-control">
                                    <a class="input-group-text cursor-pointer" wire:click="buscar"><i class="bx bx-search-alt-2"></i></a>
                                </div>
                                @error('state.CODIGO_ACTIVO') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nombre del Trabajador</label>
                                    <input type="text" class="form-control" wire:model.live="trabajador_nombre" disabled>
                                    @error('state.id')
                                        <small style="color:red">(*) Debes buscar/seleccionar un trabjador</small>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="col-lg-9">
                                <div class="mb-3">
                                    <label class="form-label">Trabajadores</label>
                                    <select wire:model="trabajador_id" class="form-select">
                                        <option value="0">Seleccione</option>
                                        @foreach($trabajadores as $trabajador)
                                            <option value="{{$trabajador->id}}">{{$trabajador->apellidoPaterno.' '.$trabajador->apellidoMaterno.' '.$trabajador->nombres}}</option>
                                        @endforeach
                                    </select>
                                    @error('trabajador_id')
                                        <small style="color:red">(*) Obligatorio</small>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-4 mb-3">
                            <label class="form-label">Correo</label>
                            <input type="text" wire:model="state.email" class="form-control">
                            @error('state.email') <span class="text-danger-emphasis">(*)Obligatorio</span> @enderror
                        </div>
                        <div class="col-lg-2">
                            <label class="form-label">Super Usuario</label>
                            <select wire:model.live="state.master" class="form-select">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Contraseña</label>
                            <select wire:model="state.password_change" class="form-select">
                                <option value="1">Verificada</option>
                                <option value="0">Resetear</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label">Estado</label>
                            <select wire:model="state.estado" class="form-select">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    @if(!$state['master'])
                        <div class="card-header bg-light">
                            <div class="row" style="padding: 10px 20px;">
                                <h6 style="display: flex; align-items: center;">
                                    <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                    <span style="margin-right: 5px;"><b>Roles del Usuario</b></span>
                                </h6>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label class="form-label">Modulo <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="modulo">
                                            <option value="0">Seleccione</option>
                                            @foreach($modulos as $vmodulo)
                                                <option value="{{$vmodulo->id}}">{{$vmodulo->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="mb-3">
                                        <label class="form-label">Rol <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model="rol">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($roles))
                                                @foreach($roles as $rol)
                                                    <option value="{{$rol->id}}">{{$rol->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>        
                                <div class="col-lg-2 d-flex align-items-center">
                                    <button type="button" class="btn btn-info" wire:click="aniadir">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="bx bxs-save" style="font-size: 22px;"></i>
                                            <span style="margin-left: 5px;"><b>Añadir Rol</b></span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:5px">#</th>
                                        <th scope="col">Modulo</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col" style="width:5px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($asignados)>0)
                                        @foreach($asignados as $asignado)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$asignado['modulo']}}</td>
                                                <td>{{$asignado['rol']}}</td>
                                                <td>
                                                    <button type="button" wire:click="del({{$asignado['id']}})" class="btn btn-danger btn-sm"><i class="ri-contacts-book-line"></i> Retirar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8">
                                                <center><i>Sin Roles Asignados</i></center>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    @if($tipo == 1 || $tipo == 3)
                        <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                            <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none"></span>
                            <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                            Guardar
                        </button>
                    @endif
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
