<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <select class="form-select m-3" aria-label="Caja" wire:model.live="caja_seleccionada_id">
                        <option selected="">Seleccione la Caja para realizar el movimiento </option>
                        @foreach ($cajas as $caja)
                            <option value="{{ $caja->id }}">{{ $caja->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3"></div>
                <div class="col-5" style="text-align: right">
                    @if($caja_seleccionada != null)                        
                        @if(optional(optional($caja_seleccionada)->movimientos)->count() == 0)
                            <button type="button" class="btn btn-outline-success btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModalApertura" wire:click='aperturaCC'>
                                <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> APERTURAR CAJA CHICA
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-secondary btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModalMovimiento" wire:click='agregar'>
                                <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> AGREGAR MOVIMIENTO
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-label waves-effect right waves-light m-3" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='cierreCC'>
                                <i class="ri-add-fill label-icon align-middle fs-16 ms-2"></i> CERRAR CAJA CHICA
                            </button>
                        @endif
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
