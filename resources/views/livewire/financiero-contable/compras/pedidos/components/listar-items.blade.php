<div class="row" style="padding: 10px 20px;">
    <div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label" for="steparrow-gen-info-email-input">Item</label>
            <select wire:model="" class="form-select form-select-sm">
                <option value="0">Seleccione</option>
                @if($items)
                    @foreach($items as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3">
            <label class="form-label" for="steparrow-gen-info-email-input">Partida de Control</label>
            <select wire:model="" class="form-select form-select-sm">
                <option value="0">Seleccione</option>
                @if($partidas)
                    @foreach($partidas as $partida)
                        <option value="{{$partida->id}}">{{$partida->id.'-'.$partida->descripcion}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="mb-3">
            <label class="form-label" for="steparrow-gen-info-email-input">Cantidad</label>
            <input type="password" class="form-control form-control-sm">
        </div>
    </div>
    <div class="col-lg-2 mt-4 text-center">
        <div class="mb-3">
            <button type="button" class="btn btn-info btn-sm" wire:click="guardar">+ Añadir Item</button>
        </div>
    </div>
</div>