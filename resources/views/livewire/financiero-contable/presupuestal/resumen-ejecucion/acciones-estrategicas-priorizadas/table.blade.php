<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 400px">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Acciones Estrategicas</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                @if($filaSeleccionada != null)
                                <button type="button" class="btn btn-danger bg-gradient waves-effect waves-light btn-sm me-2" wire:click='limpiarSeleccion'>Limpiar Filtros <i class="ri-filter-off-fill align-bottom me-1"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-striped-columns mb-4">
                            <thead>
                                <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Monto Asignado</th>
                                <th scope="col">Monto Ejecutado</th>
                                <th scope="col">Saldo</th>
                                <th scope="col">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accionEstrategicas as $accionEstrategica)
                                    <tr wire:click="seleccionarFila({{ $accionEstrategica->id }})"
                                        @if($filaSeleccionada == $accionEstrategica->id)
                                            class="table-active"
                                        @endif>               
                                        <td class="font-medium">
                                            {{ $loop->index+1 }}
                                        </td>
                                        <td>
                                            A. {{ $accionEstrategica->objetivo_estrategico->codigo }}.{{ $accionEstrategica->codigo }}
                                            <button type="button" class="btn btn-primary rounded-pill bg-gradient waves-effect waves-light btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalTooltipAO" wire:click='tooltip({{ $accionEstrategica->id }})'><i class="las la-search"></i></button></td>
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($accionEstrategica->monto_asignado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($accionEstrategica->monto_ejecutado, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            {{ Illuminate\Support\Number::currency($accionEstrategica->saldo, in: 'S/.', locale: 'en') }}
                                        </td>
                                        <td>
                                            @if($accionEstrategica->monto_asignado > 0 || $accionEstrategica->monto_asignado != null)
                                                {{ number_format($accionEstrategica->monto_ejecutado/$accionEstrategica->monto_asignado,2)*100 }} %
                                            @else
                                                0.00 %
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        {{ $accionEstrategicas->links() }}
                    </div>
                    <div class="d-none code-view">
                        
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!--end col-->
    </div>
    @script()
        <script>
            $('#plan_anual_trabajo_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#plan_anual_trabajo_id').on('change',function(){
                let a = document.getElementById("plan_anual_trabajo_id").value;
                $wire.set('form.plan_anual_trabajo_id',a);
            })
            $wire.on('cambiarSeleccion', (event) => {
                $('#plan_anual_trabajo_id').val(event.id);
                $('#plan_anual_trabajo_id').trigger('change');
            });
            $wire.on('anularSeleccion', (event) => {
                $('#plan_anual_trabajo_id').val(null).trigger('change');
            });
        </script>
        <script>
            $('#objetivo_estrategico_id').select2({
                placeholder: 'Seleccione una opcion',
                dropdownParent: '#myModal'
            });
            $('#objetivo_estrategico_id').on('change',function(){
                let a = document.getElementById("objetivo_estrategico_id").value;
                $wire.set('form.objetivo_estrategico_id',a);
            })
            $wire.on('cambiarSeleccionOE', (event) => {
                $('#objetivo_estrategico_id').val(event.id);
                $('#objetivo_estrategico_id').trigger('change');
            });
            $wire.on('anularSeleccionOE', (event) => {
                $('#objetivo_estrategico_id').val(null).trigger('change');
            });
        </script>
    @endscript
</div>

