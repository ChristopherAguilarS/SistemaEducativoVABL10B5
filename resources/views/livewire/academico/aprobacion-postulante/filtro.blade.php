<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <select class="form-select m-3" aria-label="Caja" wire:model.live="caja_seleccionada_id">
                        <option selected="">Seleccione el programa</option>
                        @foreach ($programas as $programa)
                            <option value="{{ $programa->id }}">{{ $programa->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4"></div>
                <div class="col-4" style="text-align: right">
                    <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='agregar'>
                        <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
