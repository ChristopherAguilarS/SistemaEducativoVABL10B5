<div>
    <div wire:ignore.self id="form3" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Recurso</h5>
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
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Pedido: <font style="color:red">(*)</font></label>
                                        <input type="text" disabled wire:model="state.pedido_id" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Recurso: <font style="color:red">(*)</font></label>
                                        <input type="text" disabled wire:model="nombre" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Valor de IGV:<font style="color:red">(*)</font></label>
                                        <select class="form-select form-select-sm" wire:model="state.porcentaje_igv" aria-label="Default select example">
                                            <option value="0">Sin IGV</option>
                                            <option value="8">8%</option>
                                            <option value="10">10%</option>
                                            <option value="18">18%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Cantidad: <font style="color:red">(*)</font></label>
                                        <input type="text" wire:model="state.cant" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Medida: <font style="color:red">(*)</font></label>
                                        <input type="text" disabled wire:model="medida" class="form-control form-control-sm">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <table class="table table-hover align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>  
                                                <th style="width:120px" colspan="3">
                                                    Precio Unitario
                                                </th>
                                                <th style="width:120px" colspan="2">
                                                    Parcial
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="width:120px">
                                                    SIN IGV
                                                </th>
                                                <th style="width:5px">
                                                    IGV
                                                </th>
                                                <th style="width:120px">
                                                    Con IGV
                                                </th>
                                                <th style="width:120px">
                                                    Sin IGV
                                                </th>
                                                <th style="width:120px">
                                                   Con IGV
                                                </th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input wire:model.defer="state.com_sin_igv"  type="number">
                                            </td>
                                            <td>
                                                <input wire:model.defer="state.com_igv"  type="checkbox" value="1">
                                            </td>
                                            <td>
                                                <input wire:model.defer="state.com_con_igv"  type="number">
                                            </td>
                                            <td>
                                                <input wire:model.defer="state.com_par_sin_igv"  type="number">
                                            </td>
                                            <td>
                                                <input wire:model.defer="state.com_par_con_igv"  type="number">
                                            </td>
                                            
                                        </tr>                                                                   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:click="guardar" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none; --vz-spinner-width: 1rem; --vz-spinner-height: 1rem;"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                        Guardar
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
