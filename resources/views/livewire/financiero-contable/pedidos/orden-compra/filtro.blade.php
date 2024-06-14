<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-1"></div>
                <div class="mt-4 col-1">
                    <span>Fecha Inicio:</span>
                </div>
                <div class=" col-2 mt-3">
                    <input type="date" class="form-control" wire:model.lazy='fecha_inicio'>
                </div>
                <div class="col-1 mt-4">
                    Fecha Fin:
                </div>
                <div class="col-2 mt-3">
                    <input type="date" class="form-control" wire:model.lazy='fecha_fin'>
                </div>
                <div class="col-2">
                </div>
                <div class="d-flex justify-content-end col-3">
                    <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='agregar'>
                        <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
