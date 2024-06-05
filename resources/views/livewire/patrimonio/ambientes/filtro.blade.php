<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-2">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button title="Estudios de Pre Grado" @click="$dispatch('nuevo', [0, 1])" type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class="mdi mdi-archive-plus" style="font-size:30px"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-1">
                        </div>
                        <div class="col-xxl-9">
                            <div class="row g-2">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-3">
                                    <b>Pabellon</b>
                                    <select class="form-select  mb-3 mt-2" wire:model="estado">
                                        <option value="0">Todos</option>
                                        @if(!is_null($pabellones))
                                            @foreach($pabellones as $uso)
                                                <option value="{{$uso->id}}">{{$uso->descripcion}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <b>Estado</b>
                                    <select class="form-select  mb-3 mt-2" wire:model="estado">
                                        <option value="0">Todos</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                                <div class="col-lg-2" style="margin-top:34px">
                                    <button type="button" class="btn btn-info waves-effect waves-light" wire:click="buscar" style="width:100%">Buscar</button>
                                </div>
                                <div class="col-lg-2" style="margin-top:34px">
                                    <button type="button" class="btn btn-success waves-effect waves-light" wire:click="descargar" style="width:100%">Descargar</button>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


