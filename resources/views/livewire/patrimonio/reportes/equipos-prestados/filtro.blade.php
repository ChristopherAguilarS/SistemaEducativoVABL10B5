<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-lg-3">

                        </div>
                        <div class="col-lg-6">
                            <label><b>Equipo</b></label>
                            <select class="form-select mb-3" wire:model.live="equipo" wire:change="buscar"
                                aria-label="Default select example">
                                <option value="0" selected="">Seleccione </option>
                                @foreach($equipos as $vequipo)
                                    <option value="{{$vequipo->id}}">{{$vequipo->DESCRIPCION}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-2">
                        <div class="col-lg-12" style="text-align:right">
                            <button type="button" class="btn btn-info" wire:click="buscar">Buscar</button>
                            <button type="button" class="btn btn-success" wire:click="descargar">Descargar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>