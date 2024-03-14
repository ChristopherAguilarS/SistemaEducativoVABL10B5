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
                        <div class="col-xxl-12">
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">Datos Personales | Los campos con (*) son obligatorios.</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Solicitante <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.tipoDocumento" aria-label="Default select example">
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
                                        <label class="form-label" for="steparrow-gen-info-email-input">Moneda <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.tipoDocumento" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            <option value="1" wire:key="1">SOLES</option>
                                        </select>
                                        @error('state.tipoDocumento')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Observaciones</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">ITEMS</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-info " @click="$dispatch('vItems', [1, {{$idSel}}, {{$state['tipo_id']}}, {{$state['almacen_id']}}])">+ Añadir Item</button>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-nowrap table-striped-columns mb-4">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5px" scope="col">ESTADO</th>
                                                            <th scope="col">ITEM</th>
                                                            <th scope="col">PARTIDA</th>
                                                            <th style="width:5px" class="text-center" scope="col">SOLICITADO</th>
                                                            <th style="width:5px" class="text-center" scope="col">MEDIDA</th>
                                                            <th style="width:5px" class="text-center" scope="col">ACCIONES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>                
                                                            <td class="font-medium align-middle">
                                                                
                                                            </td>
                                                            <td class="align-middle">
                                                                
                                                            </td>
                                                            <td class="align-middle">
                                                                
                                                            </td>
                                                            <td class="align-middle">
                                                                
                                                            </td>
                                                            <td class="align-middle">
                                                                
                                                            </td>
                                                            <td class="align-middle">
                                                                
                                                            </td>
                                                            <td class="align-middle">
                                                                
                                                            </td>
                                                            <td class="align-middle">
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
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
