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
                                    <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-gen-info" type="button" role="tab" aria-controls="steparrow-gen-info" aria-selected="true" data-position="0">
                                        Información del Alumno
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button" role="tab" aria-controls="steparrow-description-info" aria-selected="false" data-position="1" tabindex="-1">
                                        Datos Familiares
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false" data-position="2" tabindex="-1">
                                        Datos Complementarios
                                    </button>
                                </li>
                                 <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill" data-bs-target="#pills-experience" type="button" role="tab" aria-controls="pills-experience" aria-selected="false" data-position="2" tabindex="-1">
                                        Ficha Medica
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="steparrow-gen-info" role="tabpanel" aria-labelledby="steparrow-gen-info-tab">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="steparrow-gen-info-email-input">Tipo Documento</label>
                                                                <select class="form-select mb-3" aria-label="Default select example">
                                                                    <option selected="">Seleccione </option>
                                                                    <option value="0">DNI</option>
                                                                    <option value="2">Carnet de Extranjeria</option>
                                                                    <option value="3">Pasaporte</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please enter an email address</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                            <label class="form-label" for="steparrow-gen-info-email-input">Nro. Documento</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                                                    <span class="input-group-text"><i class="bx bx-search-alt-2"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="steparrow-description-info-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Avanzar</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            
                                            <!-- end tab pane -->

                                            <div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="pills-experience-tab">
                                                <div class="text-center">

                                                    <div class="avatar-md mt-5 mb-4 mx-auto">
                                                        <div class="avatar-title bg-light text-success display-4 rounded-circle">
                                                            <i class="ri-checkbox-circle-fill"></i>
                                                        </div>
                                                    </div>
                                                    <h5>Well Done !</h5>
                                                    <p class="text-muted">You have Successfully Signed Up</p>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
