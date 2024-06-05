<div>
    <div wire:ignore.self id="form1" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Detalle de Familia</h5>
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
                            <div class="form-group mt-4 row">
                            
                            <div class="col-md-12">
                                <label >Denominación</label>
                                <input type="text"  class="form-control" wire:model="nombreEquipo" disabled>
                            </div>
                            <div class="col-md-12"><br></div>
                            <div class="col-md-12">
                                <center class="mt-4">
                                    @if($preview) 
                                        <img src="{{ $Foto->temporaryUrl() }}" height="200"> 
                                    @else  
                                        <img src="/images/equipamiento/catalogo_equipos/{{ $urlFoto }}" height="200"> 
                                    @endif
                                    <div class="col-md-12">
                                        <span class="btn btn-light" style="margin-top: 12px;width: 200px">
                                            Adjuntar Foto
                                             <input type="file" id="imgInp" name="archivo" style="width:100%;height:100%;position:absolute;top:0;left:0;opacity:0;cursor:pointer;" wire:model.live="Foto" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="La imagen no puede ser mayor a 500px de alto y 500px de ancho y debe ser en formatos jpg,jpeg,bmp,png">
                                        </span>   
                                    </div>
                                    @error('Foto') <span class="text-danger-emphasis">{{ $message }}</span> @enderror
                                </center>
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
