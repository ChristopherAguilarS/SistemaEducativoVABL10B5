<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-12">
                            <div class="row g-2">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">
                                    <b>Nro. Expediente</b>
                                    <input type="text" class="form-control mb-3 mt-2"  wire:model="expediente">
                                </div>
                                <div class="col-lg-2">
                                    <b>Desde</b>
                                    <input type="date" class="form-control mb-3 mt-2"  wire:model="desde">
                                </div>
                                <div class="col-lg-2">
                                    <b>Hasta</b>
                                    <input type="date" class="form-control mb-3 mt-2"  wire:model="hasta">
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


