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
                                        <select class="form-select" wire:model.live="state.trabajador_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            @if($trabajadores)
                                                @foreach($trabajadores as $trabajador)
                                                    <option value="{{$trabajador->id}}">{{$trabajador->dni.'-'.$trabajador->nombres}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state.trabajador_id')
                                            <small style="color:red">(*) Obligatorio</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="steparrow-gen-info-email-input">Moneda <font style="color:red">(*)</font></label>
                                        <select class="form-select" wire:model.live="state.moneda_id" aria-label="Default select example">
                                            <option value="0">Seleccione </option>
                                            <option value="1" wire:key="1">SOLES</option>
                                        </select>
                                        @error('state.moneda_id')
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
                            @if($ver != 3)
                            <h6 style="display: flex; align-items: center;">
                                <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                                <span style="margin-right: 5px;">ITEMS</span>
                            </h6>
                            <hr style="margin: 10px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                            <div class="card-header bg-light">
                                <div class="row" style="padding: 10px 20px;">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Item</label>
                                            <select wire:model="prod.item_id" class="form-select form-select-sm">
                                                <option value="0">Seleccione</option>
                                                
                                            </select>
                                            @error('prod.item_id')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Tarea</label>
                                            <select wire:model="prod.partida" class="form-select form-select-sm">
                                                <option value="0">Seleccione</option>
                                                
                                            </select>
                                            @error('prod.partida')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="mb-3">
                                            <label class="form-label" for="steparrow-gen-info-email-input">Cantidad</label>
                                            <input type="number" wire:model="prod.cantidad" class="form-control form-control-sm text-center">
                                            @error('prod.cantidad')
                                                <small style="color:red">(*) Obligatorio</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mt-4 text-center">
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-info btn-sm" wire:click="aniadir">+ Añadir Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-hover align-middle table-nowrap mb-0">
                                                    <thead>
                                                        <tr>
                                                            @if($ver == 3)
                                                                <th
                                                                    style="width:5px"
                                                                    class="text-center"
                                                                >
                                                                    <i class="bx bx-hourglass text-warning" style="font-size:18px"></i><br>
                                                                    <input wire:model="todo" wire:click="toggleAll" value="1" name="todo" type="radio">
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                    class="text-center"
                                                                >
                                                                    <i class="bx bx-check text-success" style="font-size:18px"></i><br>
                                                                    <input wire:model="todo" wire:click="toggleAll" value="2" name="todo" type="radio">
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                    class="text-center"
                                                                >
                                                                    <i class="bx bx-no-entry text-danger" style="font-size:18px"></i><br>
                                                                    <input wire:model="todo" wire:click="toggleAll" value="3" name="todo" type="radio">
                                                                </th>
                                                            @else
                                                                <th
                                                                    style="width:5px"
                                                                    
                                                                >
                                                                    Estado
                                                                </th>
                                                                @endif
                                                                <th>
                                                                    Item
                                                                </th>
                                                                <th>
                                                                    Partida
                                                                </th>
                                                            @if($ver == 2)
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    Solicita
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    En Almacen
                                                                </th>
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    Stock Actual
                                                                </th>
                                                                <th
                                                                    style="width:120px"
                                                                >
                                                                    Aceptado
                                                                </th>
                                                            @else
                                                                <th
                                                                    style="width:120px"
                                                                >
                                                                    Solicitado
                                                                </th>
                                                                @if($ver == 2 || $ver == 3)
                                                                    <th
                                                                        style="width:120px"
                                                                    >
                                                                        Aceptado
                                                                    </th>
                                                                    @endif
                                                            @endif
                                                            <th
                                                                style="width:5px"
                                                            >
                                                                Medida
                                                            </th>
                                                            @if($ver==4 || $ver==1)
                                                                <th
                                                                    style="width:5px"
                                                                >
                                                                    Acciones
                                                                </th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
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
                    <?php
                            if($ver == 3){
                                $fun = 'aprobar1';
                            }else{
                                $fun = 'guardarPedido';
                            }
                            if($ver == 2){
                                $est = 'disabled';
                            }else{
                                $est = '';
                            }
                        ?>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-info " wire:click="{{$fun}}" wire:loading.attr="disabled">
                        <span class="spinner-border flex-shrink-0" wire:loading="" wire:target="guardar" style="display:none"></span>
                        <i class="bx bx-save" wire:loading.remove="" wire:target="guardar"></i>
                        Guardar
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
