<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-6">
                            <div class="row g-2 text-center">
                                <div class="col-lg-12 text-center">
                                    <button title="Agregar Insumo" @click="$dispatch('nuevo', 0)" type="button" class="btn btn-outline-primary waves-effect waves-light material-shadow-none">
                                        <i class='bx bx-message-alt-add' style="font-size:30px"></i>
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
                            </div>
                        </div>
                        <div class="card-body">
                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#base-justified-home" role="tab" aria-selected="false" tabindex="-1">
                                            Cumpleaños
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
                                            <div class="col-lg-4"></div> 
                                            <div class="col-lg-4">
                                                <label><b>Mes</b></label>
                                                <select class="form-select mb-3" wire:model="mes" wire:change="cEstado" aria-label="Default select example">
                                                    <option value="0" selected="">Todos </option>
                                                    <option value="1">Enero</option>
                                                    <option value="2">Febrero</option>
                                                    <option value="3">Marzo</option>
                                                    <option value="4">Abril</option>
                                                    <option value="5">Mayo</option>
                                                    <option value="6">Junio</option>
                                                    <option value="7">Julio</option>
                                                    <option value="8">Agosto</option>
                                                    <option value="9">Setiembre</option>
                                                    <option value="10">Octubre</option>
                                                    <option value="11">Noviembre</option>
                                                    <option value="12">Diciembre</option>
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


