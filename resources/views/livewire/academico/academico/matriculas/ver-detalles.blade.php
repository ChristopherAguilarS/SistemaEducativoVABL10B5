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
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 style="display: flex; align-items: center;">
                                    <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                    <span style="margin-right: 5px;"><b>BUSCAR POSTULANTE</b></span>
                                </h6>
                                <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
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
                            </div>
                        @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 style="display: flex; align-items: center;">
                                        <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                        <span style="margin-right: 5px;"><b>II. BUSCAR VACANTE </b></span>
                                    </h6>
                                    <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                                </div>
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
                                        <label class="form-label" for="steparrow-gen-info-email-input">Periodo Academico:</label>
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
                                        <label class="form-label" for="steparrow-gen-info-email-input">Ciclo:</label>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 style="display: flex; align-items: center;">
                                    <i class="bx bxs-folder-plus" style="font-size: 22px; margin-right: 5px;"></i>
                                    <span style="margin-right: 5px;"><b>III. COMPROBANTE</b></span>
                                </h6>
                                <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            </div>
                            <div class="col-12">
                                <label for="nro_requerimiento" class="col-form-label">Comprobante (pdf):</label>
                                <input class="form-control" id="formFileSm" type="file" wire:model='formTarea.documento' accept="application/pdf">
                            </div> 
                            <div class="mb-3 col-lg-3">
                                <label for="nombres" class="col-form-label">Tipo de Comprobante:</label>
                                <select class="form-select" id="genero" name="genero" wire:model='form.genero'>
                                    <option value="">Seleccionar Opcion</option>
                                    <option value="0">Perú</option> 
                                    <option value="1">Privada</option> 
                                </select><div>
                                    @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="nombres" class="col-form-label">N° Comprobante:</label>
                                <input type="number" class="form-control" id="importe" wire:model='formTarea.importe'>
                                <div>
                                    @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="nombres" class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control" wire:model='formTarea.fecha_emision'>
                                <div>
                                    @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="nombres" class="col-form-label">Monto:</label>
                                <input type="number" class="form-control" id="importe" wire:model='formTarea.importe'>
                                <div>
                                    @error('form.nombres') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
