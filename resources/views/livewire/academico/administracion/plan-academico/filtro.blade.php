<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="live-preview">
                    <div class="row align-items-center g-3">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-4">
                            <select class="form-select mb-3" wire:model.live="anio">
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                        <div class="col-lg-2" style="margin-top:-2px">
                            <button type="button" class="btn btn-info waves-effect waves-light" wire:click="buscar" style="width:100%">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>