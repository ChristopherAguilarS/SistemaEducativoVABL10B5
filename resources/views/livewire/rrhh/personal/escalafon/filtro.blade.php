<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#base-justified-home" role="tab" aria-selected="false" tabindex="-1">
                                        Listado de Trabajadores
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content  text-muted">
                                <div class="tab-pane active show" id="base-justified-home" role="tabpanel">
                                    <div class="row align-items-center g-3">
                                        <div class="col-lg-4"></div> 
                                        <div class="col-lg-4">
                                            <label><b>Trabajadores</b></label>
                                            <select class="form-select mb-3" wire:model="seleccion" wire:change="cEstado" aria-label="Default select example">
                                                <option value="0" selected="">Seleccione </option>
                                                @foreach($trabajadores as $trabajador)
                                                    <option value="{{$trabajador->id}}">{{$trabajador->nombres}} </option>
                                                @endforeach
                                            </select>
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
</div>


