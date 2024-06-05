<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                        <div class="col-xxl-3">
                            
                        </div>
                        <div class="col-xxl-1">
                        </div>
                        <div class="col-xxl-8">
                            <div class="row g-2">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4">
                                    <b>Buscar por</b>
                                    <input type="text" wire:model="search" class="form-control mt-2" placeholder="Libro, autor">
                                </div>
                                <div class="col-lg-4">
                                    <b>Estado</b>
                                    <select class="form-select  mb-3 mt-2" wire:model="estado">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
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


