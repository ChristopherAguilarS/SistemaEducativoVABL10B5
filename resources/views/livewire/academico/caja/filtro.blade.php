<div class="row dash-nft">
    <div class="col-xxl-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row align-items-center g-3">
                                <div class="col-lg-6">
                                    <b>Fecha Inicio</b>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <b>Fecha Fin</b>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" style="width:100%" class="btn btn-info material-shadow-none" wire:click="guardar">Aperturar</button>
                                </div>
                                <div class="col-lg-6">
                                    <button type="button" style="width:100%" class="btn btn-info material-shadow-none" wire:click="guardar">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-8">
        @livewire('academico.caja.table1')
    </div>
    
</div>