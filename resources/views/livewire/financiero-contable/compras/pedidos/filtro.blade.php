<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-3">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button title="Agregar Persona" @click="$dispatch('nuevo', [0, {{$almacen_id}}])" type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class="bx bx-user-plus" style="font-size:30px"></i>
                                    </button>
                                    <button title="Estudios de Pre Grado" @click="$dispatch('preGrado', 0)" type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class="bx bxs-download" style="font-size:30px"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-1">
                        </div>
                        <div class="col-xxl-8">
                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <b>Tipo</b>
                                    <select wire:model="estado" class="form-select  mb-3 mt-2">
                                        <option value="1">Materiales y  Herramientas</option>
                                        <option value="2">Servicios</option>
                                        <option value="3">Equipos</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <b>Almacen</b>
                                    <select wire:model.live="almacen_id" class="form-select  mb-3 mt-2">
                                        <option value="0">Todos</option>
                                        @foreach($almacenes as $almacen)
                                            <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <b>Revision</b>
                                    <select wire:model="estado" wire:change="cbRevision" class="form-select  mb-3 mt-2">
                                        <option value="0">Todos</option>
                                        <option value="2">Pediente</option>
                                        <option value="1">Revisado</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <b>Desde</b>
                                    <input class="form-control mb-3 mt-2" type="date" wire:model="txInicio">
                                </div>
                                <div class="col-lg-3">
                                    <b>Hasta</b>
                                    <input class="form-control mb-3 mt-2" type="date" wire:model="txFin">
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-2 mt-4">
                                    <button type="button" class="btn btn-info waves-effect waves-light" wire:click="buscar" style="width:100%">Buscar</button>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


