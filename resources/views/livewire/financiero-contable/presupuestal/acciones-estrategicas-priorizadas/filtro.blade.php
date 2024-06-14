<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-lg-3">                      
                    <select class="form-select m-3" aria-label="Objetivo Estrategico" wire:model.live="objetivo_estrategico_id">
                        <option selected="">Seleccione Objetivos Estrategicos </option>
                        @foreach ($objetivos_estrategicos as $objetivo)
                            <option value="{{ $objetivo->id }}">OE.{{ $objetivo->codigo }}.{{ Str::limit($objetivo->descripcion, 70) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-7">
                    <input type="text" class="form-control m-3" wire:model.live='busqueda' placeholder="Ingrese palabra a buscar..."> 
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='agregar'>
                        <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>