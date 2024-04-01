<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-6">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" @click="$dispatch('nuevoVacaciones', [0])">
                                        <i class="bx bx-sun" style="font-size:30px"></i><br>Vacaciones
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" @click="$dispatch('nuevoPermisos', 0)">
                                        <i class="bx bx-calendar" style="font-size:30px"></i><br>Permisos
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" @click="$dispatch('nuevoLicencias', 0)">
                                        <i class="bx bx-book-alt" style="font-size:30px"></i><br>Licencias
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" @click="$dispatch('nuevoComisiones', 0)">
                                        <i class="bx bx-bus" style="font-size:30px"></i><br>Comisiones
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none" wire:click="descargar">
                                        <i class="bx bx-cloud-download" style="font-size:30px"></i><br>Descargar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-1">
                        </div>
                        <div class="col-xxl-5">
                            <div class="row g-2 text-center">
                                <div class="col-lg-6">
                                </div>
                                <div class="col-lg-6">
                                    <select wire:model="mes" class="form-select  mb-3 mt-2">
                                        <option value="1">Con Contrato Activo</option>
                                        <option value="2">Nuevos Ingresos</option>
                                        <option value="3">Cesados</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                           <div class="card-body">
                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#base-justified-home" role="tab" aria-selected="false" tabindex="-1">
                                            Busqueda General
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#base-nombres" role="tab" aria-selected="true">
                                            Busqueda por Nombres
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#base-justified-messages" role="tab" aria-selected="false" tabindex="-1">
                                            Busqueda por Nro. Documento
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content  text-muted">
                                    <div class="tab-pane active show" id="base-justified-home" role="tabpanel">
                                        <div class="row align-items-center g-3">
                                            <div class="col-lg-4">
                                                <label><b>Tipo</b></label>
                                                <select class="form-select mb-3" wire:model.live="f_tipo" wire:change="updTable" aria-label="Default select example">
                                                    <option value="0" selected="">Todos </option>
                                                    <option value="1">Docente</option>
                                                    <option value="2">Administrativo</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label><b>Condicion</b></label>
                                                <select class="form-select mb-3" wire:model.live="f_condicion" wire:change="updTable" aria-label="Default select example">
                                                    <option value="0" selected="">Todos </option>
                                                    <option value="1">Docente</option>
                                                    <option value="2">Administrativo</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label><b>Area</b></label>
                                                <select class="form-select mb-3" wire:model.live="f_area" wire:change="updTable" aria-label="Default select example">
                                                    <option value="0" selected="">Todos </option>
                                                    <option value="1">Docente</option>
                                                    <option value="2">Administrativo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="base-nombres" role="tabpanel">
                                        @livewire('dbo.filtros.filtro-nombre-persona')
                                    </div>
                                    <div class="tab-pane" id="base-justified-messages" role="tabpanel">
                                        @livewire('dbo.filtros.filtro-documento-persona')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


