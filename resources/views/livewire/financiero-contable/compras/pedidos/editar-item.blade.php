<div>
    <div wire:ignore.self id="form2" class="modal fade" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog  modal-l">
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
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <b>Item:</b>
                                        <textarea wire:model="nomItem" class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <b>Tarea:</b>
                                        <select wire:model="state.tarea_id" class="form-select">
                                            <option value="0">Seleccione</option>
                                            @if(!is_null($partidas))
                                                @foreach($partidas as $partida)
                                                    <option value="{{$partida['id']}}">{{$partida['codigo'].'-'.$partida['descripcion']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.tarea_id')
                                            <span class="block text-left text-tiny sm:col-span-12 text-error">* Campo Obligatorio</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <b>Cantidad:</b>
                                        <input wire:model="state.cantidad" type="text" class="form-control text-center">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <b>Precio:</b>
                                        <input wire:model="state.precio" type="text" class="form-control text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:loading.attr="disabled"  wire:click="guardar">Guardar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
