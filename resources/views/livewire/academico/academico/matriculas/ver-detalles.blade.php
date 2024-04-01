<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{ $titulo }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form action="#" class="form-steps" autocomplete="off">
                        <div class="step-arrow-nav mb-4">
                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="vv1" data-bs-toggle="pill" data-bs-target="#v1" type="button" role="tab" aria-controls="v1" aria-selected="true" data-position="0">
                                        Datos Personales
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="vv2" data-bs-toggle="pill" data-bs-target="#v2" type="button" role="tab" aria-controls="v2" aria-selected="false" data-position="2" tabindex="-1">
                                        Matricula
                                    </button>
                                </li>
                                 <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="vv3" data-bs-toggle="pill" data-bs-target="#v3" type="button" role="tab" aria-controls="v3" aria-selected="false" data-position="2" tabindex="-1">
                                        Requisitos y Pago
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="v1" role="tabpanel" aria-labelledby="v1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 style="display: flex; align-items: center;">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>I. DATOS PERSONALES</b></span>
                                        </h6>
                                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Modalidad de Ingreso</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">Seleccione </option>
                                                <option value="1">Por Exoneracion</option>
                                                <option value="2">Programas de Preparacion</option>
                                                <option value="3">Ordinario</option>
                                            </select>
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Tipo Documento</label>
                                            <select class="form-select mb-3" wire:model="state.">
                                                <option selected="">Seleccione </option>
                                                <option value="0">DNI</option>
                                                <option value="2">Carnet de Extranjeria</option>
                                                <option value="3">Pasaporte</option>
                                            </select>
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Nro. Documento</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control text-center" wire.model.live="documento">
                                                <span class="cursor-pointer input-group-text" wire:click="buscar"><i class="bx bx-search-alt-2"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($busqueda)
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Apellido Paterno</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Apellido Materno</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Nombres</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Sexo</label>
                                                <select class="form-select mb-3" wire:model="state.">
                                                    <option value="0" selected="">Seleccione </option>
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h6 style="display: flex; align-items: center;">
                                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                                <span style="margin-right: 5px;"><b>Nacimiento</b></span>
                                            </h6>
                                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Pais</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Region</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Provincia</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Distrito</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Edad</label>
                                                <input type="text" class="form-control" wire.model.live="documento" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Lengua Materna</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Lengua Secundaria</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h6 style="display: flex; align-items: center;">
                                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                                <span style="margin-right: 5px;"><b>Domicilio</b></span>
                                            </h6>
                                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Region</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Provincia</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Distrito</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Direccion Actual</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <h6 style="display: flex; align-items: center;">
                                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                                <span style="margin-right: 5px;"><b>Contacto</b></span>
                                            </h6>
                                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Nro. Celular</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Email</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Persona con Discapacidad</label>
                                                <select class="form-select mb-3" wire:model="state.">
                                                    <option value="0" selected="">No </option>
                                                    <option value="1">Si</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Tipo de Discapacidad</label>
                                                <select class="form-select mb-3" wire:model="state.">
                                                    <option value="0" selected="">Seleccione </option>
                                                    <option value="1">Motora</option>
                                                    <option value="2">Visual</option>
                                                    <option value="3">Auditiva</option>
                                                    <option value="4">Mental</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Nr. CONADIS</label>
                                                <input type="text" class="form-control" wire.model.live="documento">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($state['modalidad_ingreso'] == 1)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 style="display: flex; align-items: center;">
                                                <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                                <span style="margin-right: 5px;"><b>II. EXONERACION</b></span>
                                            </h6>
                                            <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                        </div>
                                    <div class="col-lg-4"></div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="steparrow-gen-info-email-input">Motivo de Exoneracion</label>
                                                <select class="form-select mb-3" wire:model="state.">
                                                    <option value="0" selected="">Seleccione </option>
                                                    <option value="1">Primer y Segundo puesto </option>
                                                    <option value="2">Servicio Militar Voluntario</option>
                                                    <option value="3">Deportista calificado</option>
                                                    <option value="4">Egresado de COAR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h6 style="display: flex; align-items: center;">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>III. I.E. DE PROCEDENCIA</b></span>
                                        </h6>
                                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Código Modular de la I.E.</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Año que concluyó la secundaria</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Nombre o N° de la I.E</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Region</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Provincia</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Distrito</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Lugar  de la I.E</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Modalidad</label>
                                            <select class="form-select mb-3" wire:model="state.">
                                                <option value="0" selected="">Seleccione </option>
                                                <option value="1">EBR</option>
                                                <option value="2">EBA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Tipo de I.E</label>
                                            <select class="form-select mb-3" wire:model="state.">
                                                <option value="0" selected="">Seleccione </option>
                                                <option value="1">Publica</option>
                                                <option value="2">Privada</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h6 style="display: flex; align-items: center;">
                                            <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                            <span style="margin-right: 5px;"><b>IV. I.E. REQUISITOS</b></span>
                                        </h6>
                                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Certificado de Estudios</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">NO </option>
                                                <option value="1">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Partida de Nacimiento</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">NO </option>
                                                <option value="1">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Copia DNI</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">NO </option>
                                                <option value="1">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Fotos</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">NO </option>
                                                <option value="1">SI</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v2" role="tabpanel" aria-labelledby="v1">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Programa de Estudios</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">Seleccione </option>
                                                <option value="1">Por Exoneracion</option>
                                                <option value="2">Programas de Preparacion</option>
                                                <option value="3">Ordinario</option>
                                            </select>
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Periodo Academico</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">Seleccione </option>
                                                <option value="1">Por Exoneracion</option>
                                                <option value="2">Programas de Preparacion</option>
                                                <option value="3">Ordinario</option>
                                            </select>
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Ciclo</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">Seleccione </option>
                                                <option value="1">Por Exoneracion</option>
                                                <option value="2">Programas de Preparacion</option>
                                                <option value="3">Ordinario</option>
                                            </select>
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v3" role="tabpanel" aria-labelledby="v3">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Tipo de Comprobante</label>
                                            <select class="form-select mb-3" wire:model.live="state.modalidad_ingreso">
                                                <option value="0" selected="">Seleccione </option>
                                                <option value="1">Por Exoneracion</option>
                                                <option value="2">Programas de Preparacion</option>
                                                <option value="3">Ordinario</option>
                                            </select>
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Nro. Comprobante</label>
                                            <input type="text" class="form-control" wire.model.live="documento">
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Fecha</label>
                                            <input type="date" class="form-control" wire.model.live="documento">
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Monto</label>
                                            <input type="monto" class="form-control" style="text-align:right" wire.model.live="documento">
                                            <div class="invalid-feedback">Please enter an email address</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="steparrow-description-info-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Avanzar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
