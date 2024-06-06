<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        
                           <div class="card-body">
                                <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($tab == 1) active @endif" wire:click="tab_sel(1)" data-bs-toggle="tab" href="#base-justified-home" role="tab" aria-selected="false" tabindex="-1">
                                            Busqueda General
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($tab == 2) active @endif" wire:click="tab_sel(2)" data-bs-toggle="tab" href="#base-nombres" role="tab" aria-selected="true">
                                            Busqueda por Nombres
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link @if($tab == 3) active @endif" wire:click="tab_sel(3)" data-bs-toggle="tab" href="#base-justified-messages" role="tab" aria-selected="false" tabindex="-1">
                                            Busqueda por Nro. Documento
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content  text-muted">
                                    <div class="tab-pane  @if($tab == 1) active show @endif" id="base-justified-home" role="tabpanel">
                                        <div class="row align-items-center g-3">
                                            <div class="col-lg-3">
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <label><b>Ambiente</b></label>
                                                <select class="form-select mb-3" wire:model.live="ambiente" aria-label="Default select example">
                                                    <option value="0" selected="">Todos </option>
                                                    @foreach($ambientes as $ambiente)
                                                        <option value="{{$ambiente->id}}">{{$ambiente->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane @if($tab == 2) active show @endif" id="base-nombres" role="tabpanel">
                                        <div class="row align-items-center g-3">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <div class="col-lg-12">
                                                    <input class="form-control" type="text" wire:model="nombres" placeholder="Nombres">
                                                </div>
                                                <div class="col-lg-12 mt-2">
                                                    <input class="form-control" type="text" wire:model="apPaterno" placeholder="Apellido Paterno">
                                                </div>
                                                <div class="col-lg-12 mt-2">
                                                    <input class="form-control" type="text" wire:model="apMaterno" placeholder="Apellido Materno">
                                                </div>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane @if($tab == 3) active show @endif" id="base-justified-messages" role="tabpanel">
                                        <div  class="row align-items-center g-3">
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4">
                                                <div class="col-lg-12">
                                                    <input class="form-control" type="text" wire:model="nroDocumento" placeholder="Nro. Documento">
                                                </div>
                                            </div>
                                            <div class="col-lg-4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
</div>


