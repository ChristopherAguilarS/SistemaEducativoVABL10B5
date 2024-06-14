<div>
    <div class="card">
        <div class="row">
            <div class="col-4 mt-6">
                <select class="form-select mb-3" aria-label="Default select example" wire:model.live='añoSeleccionado'>
                    <option selected="">Seleccione Año</option>
                    @foreach ($años as $año)
                        <option value="{{ $año }}">{{ $año }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6"></div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='agregar'>
                    <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                </button>
            </div>
        </div>
    </div>
</div>
