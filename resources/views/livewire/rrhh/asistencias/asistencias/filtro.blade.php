<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-3">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" @click="$dispatch('nuevo', 0)">
                                        <i class="bx bx-refresh" style="font-size:30px"></i><br>Procesar
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" @click="$dispatch('nuevoAdenda', 0)">
                                        <i class="bx bx-upload" style="font-size:30px"></i><br>Importar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-1">
                        </div>
                        <div class="col-xxl-8">
                            <div class="row">
                                <div class="col-lg-3">
                                    <b>Tipo</b>
                                    <select wire:model="mes" class="form-select  mb-3 mt-2">
                                        <option value="1">Real</option>
                                        <option value="2">Procesado</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <b>Estado</b>
                                    <select wire:model="mes" class="form-select  mb-3 mt-2">
                                        <option value="1">Real</option>
                                        <option value="2">Procesado</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <b>Trabajador</b>
                                    <select wire:model="mes" class="form-select  mb-3 mt-2">
                                        <option value="1">Real</option>
                                        <option value="2">Procesado</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <b>Mes</b>
                                    <select wire:model="mes" class="form-select  mb-3 mt-2">
                                        <option value="1">Real</option>
                                        <option value="2">Procesado</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <b>Año</b>
                                    <select wire:model="mes" class="form-select  mb-3 mt-2">
                                        <option value="1">Real</option>
                                        <option value="2">Procesado</option>
                                    </select>
                                </div>
                                <div class="col-lg-6" style="text-align:center; margin-top:20px">
                                    <button type="button" class="btn btn-info waves-effect waves-light" wire:click="buscar"> <i class="bx bx-search-alt-2"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-lg-12" style="text-align:right">
                                <button type="button" class="btn btn-success btn-sm" wire:click="descargar">Descargar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


