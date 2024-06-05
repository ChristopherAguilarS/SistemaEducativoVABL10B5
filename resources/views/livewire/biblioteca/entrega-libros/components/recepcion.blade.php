<div>
    <div wire:ignore.self id="form2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">{{$titulo}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <hr>
                <div class="modal-body" style="padding:0px">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <center><h4>"{{$state['libro']}}"</h4><h6>{{$state['autor']}}</h6></center>
                                <?php 
                                    if($state['imagen']){
                                        $rImagen = $state['idi'].'.'.$state['imagen'];
                                    }else{
                                        $rImagen = 'sin_foto.jpeg';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4 p-4">
                            <div class="bg-light rounded p-1" style="    width: 10rem;">
                                <img src="/images/libros/{{$rImagen}}" alt="" class="img-fluid d-block">
                            </div>
                        </div>
                        <div class="col-lg-8 p-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label><b>Fecha de Entrega</b></label>
                                    <input type="date" class="form-control" wire:model="entrega.fecha">
                                    @error('entrega.fecha')
                                        <small style="color:red">(*) Obligatorio</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label><b>Hora de Entrega</b></label>
                                    <input type="time" class="form-control" wire:model="entrega.hora">
                                    @error('entrega.hora')
                                        <small style="color:red">(*) Obligatorio</small>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label><b>Observaciones</b></label>
                                    <textarea class="form-control" wire:model="entrega.observaciones"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <hr>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                   
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
