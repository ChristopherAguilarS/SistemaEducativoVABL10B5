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
                                            @if($foto)
                                                <img src="{{ $foto->temporaryUrl() }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                            @else
                                                <img src="{{ asset($urlFoto) }}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                            @endif
                                            
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" wire:model.live="foto" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <!--
                                        <h5 class="fs-16 mb-1">Anna Adame</h5>-->
                                        <p class="text-muted mb-0">
                                            <?php
                                                if($foto){
                                                    echo $foto->getClientOriginalName();
                                                }else{
                                                    echo ' Click para subir archivo';
                                                }
                                            ?>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-9">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Datos Personales | Los campos con (*) son obligatorios.</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Tipo Documento <font style="color:red">(*)</font></label>
                                        <select class="form-select form-select-sm" wire:model.live="state.tipoDocumento" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            <option value="1" wire:key="1">DOCUMENTO NACIONAL DE IDENTIDAD</option>   
                                            <option value="4" wire:key="4">CARNET DE EXTRANJERÍA</option>    
                                            <option value="6" wire:key="6">REGISTRO UNICO DE CONTRIBUYENTES</option>    
                                            <option value="7" wire:key="7">PASAPORTE</option>    
                                            <option value="A" wire:key="A">CÉDULA DIPLOMATICA DE IDENTIDAD</option>    
                                            <option value="B" wire:key="B">DOC.IDENT.PAIS.RESIDENCIA-NO.D</option>    
                                            <option value="C" wire:key="C">TAX IDENTIFICATION NUMBER - TIN – DOC TRIB PP.NN</option>    
                                            <option value="D" wire:key="D">IDENTIFICATION NUMBER - IN – DOC TRIB PP. JJ</option>    
                                            <option value="E" wire:key="E">TAM- TARJETA ANDINA DE MIGRCIÓN</option>    
                                            <option value="F" wire:key="F">PERMISO TEMPORAL DE PERMANENCIA - PTP</option>    
                                        </select>
                                        @error('state.tipoDocumento')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                    <label class="form-label" for="steparrow-gen-info-email-input">Nro. Documento <font style="color:red">(*)</font></label>
                                        <div class="input-group">
                                            <input type="text" wire:model.live="state.numeroDocumento" class="form-control form-control-sm" aria-label="Dollar amount (with dot and two decimal places)">
                                            <span class="input-group-text"><i class="bx bx-search-alt-2"></i></span>
                                        </div>
                                        @error('state.numeroDocumento')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Genero</label>
                                        <select class="form-select form-select-sm" wire:model.live="state.sexo" aria-label="Default select example">
                                            <option value="0" selected="">Seleccione </option>
                                            <option value="1">Masculino</option>
                                            <option value="2">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Nombres <font style="color:red">(*)</font></label>
                                        <input class="form-control form-control-sm" wire:model.live="state.nombres" type="text">
                                        @error('state.nombres')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Apellido Paterno <font style="color:red">(*)</font></label>
                                        <input class="form-control form-control-sm" wire:model.live="state.apellidoPaterno" type="text">
                                        @error('state.apellidoPaterno')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Apellido Materno <font style="color:red">(*)</font></label>
                                        <input class="form-control form-control-sm" wire:model.live="state.apellidoMaterno" type="text">
                                        @error('state.apellidoMaterno')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Fecha Nacimiento</label>
                                        <input class="form-control form-control-sm" wire:model.live="state.fechaNacimiento" type="date">
                                        @error('state.fechaNacimiento')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Estado Civil</label>
                                        <select class="form-select form-select-sm" wire:model.live="state.estadoCivil" aria-label="Default select example">
                                            <option value="0" selected="">Seleccione </option>
                                            <option value="1">Soltero</option>
                                            <option value="2">Casado</option>
                                        </select>
                                         <div class="invalid-feedback">Please enter an email address</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Telefono(s)</label>
                                        <input class="form-control form-control-sm" wire:model.live="state.telefonos" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Lugar de Nacimiento</label>
                                        <input class="form-control form-control-sm" wire:model.live="state.lugar_nacimiento" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Correo Electrónico</label>
                                        <input class="form-control form-control-sm" wire:model.live="state.email" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Dirección</label>
                                        <input class="form-control form-control-sm" wire:model.live="state.direccion" type="text">
                                    </div>
                                </div>
                            </div>
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Adjuntar Archivos | Campos opcionales.</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="card-header bg-info d-flex align-items-center justify-content-center" style="padding: 0px 20px;">
                                            <h4 class="text-white card-title m-0"><small>FICHA DE DATOS (.pdf)</small></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="card-header bg-info d-flex align-items-center justify-content-center" style="padding: 0px 20px;">
                                            <h4 class="text-white card-title m-0"><small>DOCUMENTO DE IDENTIDAD (.pdf)</small></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-md-8 offset-md-2">
                                        <span class="btn btn-light" style="width: 100%">
                                            @if($ficha)
                                                <i class="bx bx-check-square" style="color:green"></i>
                                            @else
                                                <i class="bx bxs-file-pdf"></i>
                                            @endif
                                            @php
                                                if($ficha){
                                                    echo $ficha->getClientOriginalName();
                                                }else{
                                                    echo ' Click para subir archivo';
                                                }
                                            @endphp
                                            <div wire:loading="" wire:target="ficha">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                            <input type="file" style="width:100%;height:100%;position:absolute;top:0;left:0;opacity:0;cursor:pointer;" wire:model.live="ficha">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-md-8 offset-md-2">
                                        <span class="btn btn-light" style="width: 100%">
                                            @if($dni)
                                                <i class="bx bx-check-square" style="color:green"></i>
                                            @else
                                                <i class="bx bxs-file-pdf"></i>
                                            @endif
                                            @php
                                                if($dni){
                                                    echo $dni->getClientOriginalName();
                                                }else{
                                                    echo ' Click para subir archivo';
                                                }
                                            @endphp
                                            <div wire:loading="" wire:target="dni">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                            <input type="file" style="width:100%;height:100%;position:absolute;top:0;left:0;opacity:0;cursor:pointer;" wire:model.live="dni">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <small><b>NOTA:</b> si vuelve a subir un archivo adjunto, este se reemplazara los archivos ya cargados.</small>
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
