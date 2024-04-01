<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-3">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button title="Agregar Persona" @click="$dispatch('nuevo', [0, 1])" type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class="bx bx-folder-plus" style="font-size:30px"></i>
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
                                <div class="col-lg-4"></div>    
                                <div class="col-lg-3">
                                    <b>Ciclo</b>
                                    <select wire:model="estado" class="form-select  mb-3 mt-2">
                                        <option value="0">Todos</option>
                                        <option value="1">Activo</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <b>Estado</b>
                                    <select wire:model="estado" class="form-select  mb-3 mt-2">
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                    </select>
                                </div>
                                <div class="col-lg-2" style="margin-top:34px">
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


