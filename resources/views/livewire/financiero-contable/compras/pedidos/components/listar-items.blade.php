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
                        <h6 style="display: flex; align-items: center;">
                            <i class="bx bxs-user-voice" style="font-size: 22px; margin-right: 5px;"></i>
                            <span style="margin-right: 5px;"><b>Trabajador</b></span>
                        </h6>
                        <hr style="margin: 4px; flex-grow: 1; border: none; border-top: 1px solid #000;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                <label class="form-label" for="steparrow-gen-info-email-input">Buscar:</font></label>
                                    <input class="form-control form-control-sm" wire:keydown.enter="rtabl"  wire:model="search" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @if($search)
                                    @livewire('financiero-contable.compras.pedidos.components.listar-items-tabla')
                                @else
                                    <center><i>Ingresa un criterio de busqueda</i></center>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                <b>Item(s) Seleccionado:</b>
                                <table style="width:100%">
                                    @if($itemSel)
                                        <tr>
                                            <td><b>Descripción</b></td>
                                            <td style="width:80px"><b>Cant</b></td>
                                            <td><b>Partida de Control</b></td>
                                            <td style="width:10px"><b>Precio</b></td>
                                        </tr>
                                        @foreach($itemSel as $iitem)
                                            <tr>
                                                <td>
                                                    <textarea disabled cols="30" rows="2" {{$iitem['nom']}} class="form-control" id="exampleFormControlTextarea5" rows="3"></textarea>
                                                </td>
                                                <td style="width:80px">
                                                    <input  type="number" wire:model.delay="itemSel.{{$iitem['id']}}.cant" class="form-control">
                                                </td>
                                                <td>
                                                    <select wire:model.delay="itemSel.{{$iitem['id']}}.partida" class="mt-1 form-select h-8 w-full rounded border border-slate-300 bg-white px-2.5 text-xs+ hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                                        <option value="0">Seleccione</option>
                                                        @if($titulos)
                                                            @foreach($titulos as $titulo)
                                                                <optgroup label="{{$titulo->nom}}"></optgroup>
                                                                @if($partidas)
                                                                    @foreach($partidas->where('partidaTitulo_id', $titulo->id) as $partida)
                                                                        <option value="{{$partida->id}}">{{$partida->nom}}</option>
                                                                    @endforeach
                                                                 @endif
                                                             @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td style="width:80px">
                                                    <input  type="number" wire:model.delay="itemSel.{{$iitem['id']}}.com_sin_igv" class="form-control">
                                                </td>
                                                <td style="width:10px">
                                                    <button wire:click="$emit('delItem', {{$iitem['id']}})" class="form-control">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <center><i>Selecciona un Item</i></center>
                                    @endif
                                </table>
                                @error('state.item_id')
                                    <span class="block text-left text-tiny sm:col-span-12 text-error">* Debes seleccionar un item</span>
                                @enderror
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
    </div>
</div>