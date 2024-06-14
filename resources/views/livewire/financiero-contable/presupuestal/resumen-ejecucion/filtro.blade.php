<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-center mt-4">
                <div class="col-4">
                </div>
                <div class="col-4">
                    <select class="form-select mb-3" aria-label="Default select example" wire:model.live='añoSeleccionado'>
                        <option selected="">Seleccione Año Escolar </option>
                        @foreach ($años as $año)
                            <option value="{{ $año->id }}">{{ $año->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 text-right mt-2" style="text-align: right">
                    <button type="button" class="btn btn-success waves-effect waves-light btn-sm me-2" wire:click='exportEjecucion'>Exportar Ejecución de Gasto</button>
                </div>
                <div class="col-2 text-left mt-2">
                    <button type="button" class="btn btn-success waves-effect waves-light btn-sm me-2" wire:click='exportResumen'>Exportar Resumen Pat</button>
                </div>
            </div>
            <div class="row g-4 px-4">
                <div class="col-3">
                    <!-- card -->
                    <div class="card card-animate card-success ">
                        <div class="card-body">
                            <div class="d-flex align-items-center p-3">
                                <p class="card-text">
                                    <span class="fw-medium fs-22 fw-semibold mt-4">S/. {{ number_format($monto_presupuestado, 2, ',', '.') }}</span>
                                    <br>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">Presupuesto Anual</span>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">_____</span>
                                </p>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
                <div class="col-3">
                    <!-- card -->
                    <div class="card card-animate card-danger ">
                        <div class="card-body">
                            <div class="d-flex align-items-center p-3">
                                <p class="card-text">
                                    <span class="fw-medium fs-22 fw-semibold mt-4">S/. {{ number_format($monto_ejecutado, 2, ',', '.') }}</span>
                                    <br>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">Presupuesto Gastado</span>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">_____</span>
                                </p>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
                <div class="col-3">
                    <!-- card -->
                    <div class="card card-animate card-info ">
                        <div class="card-body">
                            <div class="d-flex align-items-center p-3">
                                <p class="card-text">
                                    <span class="fw-medium fs-22 fw-semibold mt-4">S/. {{ number_format($monto_presupuestado - $monto_ejecutado, 2, ',', '.') }}</span>
                                    <br>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">Saldo</span>
                                    <br>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">_____</span>
                                </p>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
                <div class="col-3">
                    <!-- card -->
                    <div class="card card-animate card-primary ">
                        <div class="card-body">
                            <div class="d-flex align-items-center p-3">
                                <p class="card-text">
                                    <span class="fw-medium fs-22 fw-semibold mt-4">
                                        @if($monto_presupuestado != null || $monto_presupuestado > 0)
                                            {{ number_format($monto_ejecutado/$monto_presupuestado, 2)*100 }}
                                        @else
                                            0.00
                                        @endif %
                                        </span>
                                    <br>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">Ejecutado</span>
                                    <br>
                                    <span class="fw-medium fs-22 fw-semibold mt-4">_____</span>
                                </p>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div>
        </div>
    </div>
</div>
