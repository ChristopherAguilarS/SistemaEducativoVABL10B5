<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="col-lg-12 text-center">
                                <br><br>
                            </div>
                            <div class="col-lg-12 text-center mt-10">
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            @if($preview)
                                                <img class="w-full shrink-0 rounded-t-lg bg-cover bg-center object-cover object-center lg:h-auto lg:rounded-t-none lg:rounded-l-lg"
                                                src="{{ $Foto->temporaryUrl() }}" alt="image">
                                            @else
                                                @if($estadoFoto)
                                                    <img class="w-full shrink-0 rounded-t-lg bg-cover bg-center object-cover object-center lg:h-auto lg:rounded-t-none lg:rounded-l-lg" src="{{ asset('images/'.$urlFoto) }}" alt="image">
                                                @else

                                                @endif
                                            @endif
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" wire:model.live="Foto" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-9">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Información de Insumo.</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Categoria <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.catalogoCategoria_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            @if(!is_null($categorias))
                                                @foreach($categorias as $equipo)
                                                    <option value="{{$equipo->id}}">{{$equipo->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogoCategoria_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Modelo: <font style="color:red">(*)</font></label>
                                        <input type="text" wire:model.live="state.modelo" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                        @error('state.modelo')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Código: <font style="color:red">(*)</font></label>
                                    <input type="text" wire:model.live="state.codigo_insumo" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                        @error('state.codigo_insumo')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Unidad de Medida <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.catalogoUnidadMedida_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            @if(!is_null($unidades))
                                                @foreach($unidades as $equipo)
                                                    <option value="{{$equipo->id}}">{{$equipo->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.catalogoUnidadMedida_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Nombre del Producto: <font style="color:red">(*)</font></label>
                                        <input class="form-control" wire:model.live="state.nombre" type="text">
                                        @error('state.nombre')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Descripción <font style="color:red">(*)</font></label>
                                        <input class="form-control" wire:model.live="state.descripcion" type="text">
                                        @error('state.descripcion')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Stock Mínimo</label>
                                        <input class="form-control" wire:model.live="state.stockMinimo" type="number">
                                        @error('state.stockMinimo')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Estado</label>
                                        <select class="form-select" wire:model.live="state.estado" aria-label="Default select example">
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:click="guardar">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
